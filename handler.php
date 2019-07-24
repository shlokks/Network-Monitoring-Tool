<html>
    
    <header><center>Result</center></header>
    
    <head>
        <title>Result</title>
        <link rel="stylesheet" type="text/css" href="style_result.css">
    </head>
    <br><br><br><br><br><br><br><br>
    <body>
        <div class="result-box">

            <?php 
                #php code to handle the user requests and display the data
            
                # command to capture packets and store in a pcap file
                $cmd = "sudo tcpdump -i wlp5s0 -c 10 -w packets.pcap";

                # capturing the data from the protocol page
                $button = $_POST['protocol'];
                $option = $_POST['menu'];

                # if user submits without selecting options redirect to page again
                if($button == null or $option == null){
                    header('Location: protocol.html');
                }

                # create a table for displaying the data
                if ($option == "all") {
                    echo "<table style = 'width: 100%;'>";
                  }
                else {
                    echo "<table>";
                }


                # update the command to execute for the specific protocol selected by user
                $cmd = $cmd . " " . $button;    
                echo shell_exec($cmd);

                # update command to read the pacp file
                $cmd = "sudo tcpdump -r packets.pcap -nn";


                # display table headers
                echo "<tr>";

                if($option == "timestamp" || $option == "all"){
                    echo "<td>Timestamp</td>";
                }

                if($option == "sip" || $option == "all"){
                    echo "<td>Source IPv4</td>";
                }

                if($option == "sport" || $option == "all"){
                    echo "<td>Source Port</td>";
                }

                if($option == "dip" || $option == "all"){
                    echo "<td>Destination IPv4</td>";
                }

                if($option == "dport" || $option == "all"){
                    echo "<td>Destination Port</td>";
                }

                if($option == "smac" || $option == "all"){
                    echo "<td>Source MAC</td>";
                }

                if($option == "dmac" || $option == "all"){
                    echo "<td>Destination MAC</td>";
                }

                if($option == "packetLength" || $option == "all"){
                    echo "<td>Packet length</td>";
                }
                echo "</tr>";


                # for tcp packets
                if($button == "tcp") {

                    # execute following commands to cut and display the columns
                    exec($cmd . " | cut -d ' ' -f 1", $timestamp, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 3 | cut -d '.' -f 1,2,3,4", $sip, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 3 | cut -d '.' -f 5", $sport, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 5 | cut -d '.' -f 1,2,3,4", $dip, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 5 | cut -d '.' -f 5 | cut -d ':' -f 1", $dport, $returnVal);
                    exec($cmd . " -e | cut -d ' ' -f 2", $smac, $returnVal);
                    exec($cmd . " -e | cut -d ' ' -f 4 | cut -d ',' -f 1", $dmac, $returnVal);
                    exec($cmd . " | awk '{print $(NF)}'", $packetLength, $returnVal);

                    # using for loop to display the data row by row
                    for($i = 0; $i < sizeof($timestamp); $i += 1){

                        # start row
                        echo "<tr>";

                        # check conditions

                        if($option == "timestamp" || $option == "all"){
                            echo "<td>".$timestamp[$i]."<br></td>";                
                        }

                        if($option == "sip" || $option == "all"){
                            echo "<td>".$sip[$i]."<br></td>";
                        }

                        if($option == "sport" || $option == "all"){
                            echo "<td>".$sport[$i]."<br></td>";
                        }

                        if($optin == "dip" || $option == "all"){
                            echo "<td>".$dip[$i]."<br></td>";
                        }

                        if($option == "dport" || $option == "all"){
                            echo "<td>".$dport[$i]."<br></td>";
                        }

                        if($option == "smac" || $option == "all"){
                            echo "<td>".$smac[$i]."<br></td>";
                        }

                        if($option == "dmac" || $option == "all"){
                            echo "<td>".$dmac[$i]."<br></td>";
                        }

                        if($option == "packetLength" || $option == "all"){
                            echo "<td>".$packetLength[$i]."<br></td>";
                        }
                        # close row
                        echo "</tr>";
                    }
                }  


                # for udp packets
                else if($button == "udp") {

                    # execute following commands to cut and display the columns
                    exec($cmd . " | cut -d ' ' -f 1", $timestamp, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 3 | cut -d '.' -f 1,2,3,4", $sip, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 3 | cut -d '.' -f 5", $sport, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 5 | cut -d '.' -f 1,2,3,4", $dip, $returnVal);
                    exec($cmd . " | cut -d ' ' -f 5 | cut -d '.' -f 5 | cut -d ':' -f 1", $dport, $returnVal);
                    exec($cmd . " -e | cut -d ' ' -f 2", $smac, $returnVal);
                    exec($cmd . " -e | cut -d ' ' -f 4 | cut -d ',' -f 1", $dmac, $returnVal);
                    exec($cmd . " | grep 'UDP' | grep -v 'NBT' | awk '{print $(NF)}'", $packetLength, $returnVal);

                    # using for loop to display data
                    for($i = 0; $i < sizeof($timestamp); $i += 1){

                        # strat row
                        echo "<tr>";

                        # check conditions

                        if($option == "timestamp" || $option == "all"){
                            echo "<td>".$timestamp[$i]."<br></td>";                
                        }

                        if($option == "sip" || $option == "all"){
                            echo "<td>".$sip[$i]."<br></td>";
                        }

                        if($option == "sport" || $option == "all"){
                            echo "<td>".$sport[$i]."<br></td>";
                        }

                        if($optin == "dip" || $option == "all"){
                            echo "<td>".$dip[$i]."<br></td>";
                        }

                        if($option == "dport" || $option == "all"){
                            echo "<td>".$dport[$i]."<br></td>";
                        }

                        if($option == "smac" || $option == "all"){
                            echo "<td>".$smac[$i]."<br></td>";
                        }

                        if($option == "dmac" || $option == "all"){
                            echo "<td>".$dmac[$i]."<br></td>";
                        }

                        if($option == "packetLength" || $option == "all"){
                            echo "<td>".$packetLength[$i]."<br></td>";
                        }

                        # close row
                        echo "</tr>";
                    }        
                }

                # for arp packets
                else {

                    # execute following commands to cut and display the columns
                    exec($cmd . " | cut -d ' ' -f 1", $timestamp, $returnVal);
                    exec($cmd . " -e | grep -v 'is-at' | cut -d ' ' -f 2", $smac, $returnVal);
                    exec($cmd . " -e | grep -v 'is-at' | cut -d ' ' -f 4 | cut -d ',' -f 1", $dmac, $returnVal);
                    exec($cmd . " | awk '{print $(NF)}'", $packetLength, $returnVal);

                    # display data
                    for($i = 0; $i < sizeof($timestamp); $i += 1){

                        # start row
                        echo "<tr>";

                        # check conditions

                        if($option == "timestamp" || $option == "all"){
                            echo "<td>".$timestamp[$i]."<br></td>";                
                        }

                        if($option == "sip" || $option == "all"){
                            echo "<td>".$sip[$i]."<br></td>";
                        }

                        if($option == "sport" || $option == "all"){
                            echo "<td>".$sport[$i]."<br></td>";
                        }

                        if($optin == "dip" || $option == "all"){
                            echo "<td>".$dip[$i]."<br></td>";
                        }

                        if($option == "dport" || $option == "all"){
                            echo "<td>".$dport[$i]."<br></td>";
                        }

                        if($option == "smac" || $option == "all"){
                            echo "<td>".$smac[$i]."<br></td>";
                        }

                        if($option == "dmac" || $option == "all"){
                            echo "<td>".$dmac[$i]."<br></td>";
                        }
                        if($option == "packetLength" || $option == "all"){
                            echo "<td>".$packetLength[$i]."<br></td>";
                        }

                        # close row
                        echo "</tr>";
                    }
                }

            # close the table
            echo "</table>";
            ?>
        </div>    
    </body>
    <footer >Developed by SHLOK KASHYAP</footer>
</html>



