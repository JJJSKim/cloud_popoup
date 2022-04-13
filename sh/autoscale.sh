
workers=("17.7.1.129" "17.7.1.130")       #워커 지정
max_replication=10                              #최대 replication
min_replication=2                               #최소 replication
var_replication=2                               #replication 변동폭
max_value=30                                    #cpu/ram max 임계값(%) 해당값 이상일시 replication 증가
min_value=30                                    #cpu/ram min 임계값(%) 해당값 이하일시 replication 감소

###각 워커 반복 시작###
for var in "${workers[@]}"
do
###자원 사용율 확인###
        cpu_val=$(ssh -i /root/.ssh/m1.pem root@${var} docker stats --no-stream | awk  'NR >= 2 {sum +=$3; cnt++} END {print sum/cnt}')
        ram_val=$(ssh -i /root/.ssh/m1.pem root@${var} docker stats --no-stream | awk  'NR >= 2 {sum +=$7; cnt++} END {print sum/cnt}')
        replica_status=$(docker service inspect -f '{{ .Spec.Mode.Replicated.Replicas }}' bao_webservice)

###자원 사용율이 최대 세팅값을 넘을 경우###
        if [[ $(echo "${cpu_val} > $max_value" | bc) -eq 1 ]] ||  [[ $(echo "${ram_val} > $max_value" | bc) -eq 1 ]]
        then
        ###현제 리플리케이션 값이 최대 리플리케이션 값보다 작을 경우###    bao_webservice
                if [[ $replica_status -lt $max_replication ]]
                then
                        ###리플리케이션 증가###
                        docker service scale bao_webservice=$(expr ${replica_status} + $var_replication)
                        #exit
                fi
###자원 사용율이 최소 세팅값보다 작을 경우###
        elif [[ $(echo "${cpu_val} < $min_value" | bc) -eq 1 ]] ||  [[ $(echo "${ram_val} < $min_value" | bc) -eq 1 ]]
        then
        ###현재 리플리케이션 값이 최소 리플리케이션 값보다 클 경우###
                if [[ $replica_status -gt 2 ]]
                then
                        ###리플리케이션 감소###
                        docker service scale bao_webservice=$(expr ${replica_status} - $var_replication)
                        #exit
                fi
        fi

### Cluster2를 동작시키는 경우 ###
        if [[ $replica_status -gt 6 ]]
        then
                echo 1 > a.txt
                cl2check=$(cat a.txt)
                if [[ -z $cl2check ]]
                then
                        ssh -i /root/.ssh/m1.pem root@17.7.1.110 ./halist.sh                    ### lb에 manager2의 주소를 기입 해주고 재실행
                        ssh -i /root/.ssh/m1.pem root@17.7.1.228 ./service.sh                   ### manager2에게 webservice 실행
                        ssh -i /root/.ssh/m1.pem root@17.7.1.228 ./cron.sh                      ### manager2의 webservice 관리를 위한 크론탭 설정
                fi
        elif [[ $replica_status -lt 4 ]]
        then
                echo  > a.txt
                cl2check=$(cat a.txt)
                if [[ -z $cl2check ]]
                then
                        ssh -i /root/.ssh/m1.pem root@17.7.1.110 ./halistd.sh                   ### lb에 manager2의 주소를 삭제
                        ssh -i /root/.ssh/m1.pem root@17.7.1.228 ./serviced.sh          ### manager2의 서비스 삭제
                        ssh -i /root/.ssh/m1.pem root@17.7.1.228 ./crond.sh                     ### manager2의 webservice 관리를 위한 크론탭 삭제
                fi
        fi
exit
done
