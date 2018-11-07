<!DOCTYPE html>

<!-- AUTORI: 
Paolo Peretti -- Nicola Pallavidino -- Abbas Abdirashid  -->
<html>
<head> 
		<title>Movie</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
        <link rel="icon" href="https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" />
</head>

<body>
		<div id="img">
        <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes" />
		</div>
        
    
        <?php $movie=$_GET["film"];                             //scelta film
            $lines=file($movie ."/info.txt");                   //accesso a info.txt 
            list ($titolo, $anno, $gradimento) = $lines;        //list spacchetta il file
        ?>
		
    
        <h1>
        <?php echo $titolo;
        ?> (
        <?php
            echo $anno;
        ?>
           )
        </h1>
        
		
<div id="main">
        <!-- colonna sinistra-->
            <div id="left">
                <div id ="leftArea">
                <?php if ($gradimento > 60) {               //scelta del banner in base al rating 
                ?>
                <img src= "http://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/freshbig.png" alt="fresh" class="vistaImmagine"/>
                <?php echo $gradimento ; ?>                
                <?php }
                    else {?>
                <img src= "https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rottenbig.png" alt="rotten" class="vistaImmagine"/>
                <?php  echo $gradimento; } ?>%
                </div>

                
                <!-- colonna interna sinistra -->
                <div id="leftColumn">
                    <?php $arrayFile = glob("$movie/review*.txt");     //con la funzione globe recupero i dati cioè le recensioni dal txt
                    $lunghezza= count($arrayFile);                     //salvo in $arrayFile, in seguito vado a vedere $arrayFile.lenght
                    for ($i=0 ; $i<$lunghezza/2; $i++) {               //stampo prima meta di sinistra con ciclo for, il resto a destra
                    ?>                                                    
            
                    <div class="recensione">
                        <p class="testoRecensione">
                        <?php                                     //utilizziamo la funzione file serve per accedere ad $arrayFile (che contiene                                           i vari review.txt che avevo globbato)
                        $a = file ($arrayFile[$i]);               //spacchetto i vari file e li salvo in un array con la funzione list
                        list ($testo, $simbolo, $autore, $testata) = $a;    
                        
                        if (trim($simbolo) == "ROTTEN") {        //trim elimina gli spazi bianchi e poi guardo $simbolo = FRESH o ROTTEN? per                                            decidere i vari banner

                        ?>
                        <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten" class="vistaImmagine" />
                        <?php } 
                        else { 
                        ?>
                        <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="fresh" class="vistaImmagine" />
                        <?php    }
                        echo $testo;
                        ?>
                        </p>
                    </div>
                    <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic" class="vistaImmagine" />
                    <div>
                        <p class="pubblicazione"><?php echo $autore ?> <br />
                        <?php echo $testata ?></p></div>
                        <?php 
                        } 
                        ?>                
                </div>    <!--CHIUSURA DIV leftColumn-->
        

                <!-- colonna interna destra -->
                <div id="rightColumn">
                    <?php $arrayFile = glob("$movie/review*.txt");  //tramite la funzione glob recuperiamo tutti i vari file con estensione                                                     .txt che contengono le recensioni
                    $lunghezza= count($arrayFile);                  //salvo il risultato in $arrayFile, poi $arrayFile.lenght
                    for ($j=$i ; $j<$lunghezza; $j++) {             //stampo prima meta con un for, il resto a destra
                    ?>
                        <div class="recensione">
                            <p class="testoRecensione">
                            <?php                                   //file accede ad $arrayFile (che contiene i vari review.txt) 
                            $a = file ($arrayFile[$j]);             //salvo i file in un array con la funzione list
                            list ($testo, $simbolo, $autore, $testata) = $a;    
                            if (trim($simbolo) == "ROTTEN") {      //trim etc.....
                                                           
                            ?>
                            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten" class="vistaImmagine" />
                            <?php } 
                            else { 
                            ?>
                            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="fresh" class="vistaImmagine" />
                            <?php    }
                            echo $testo;
                            ?>
                            </p>
                        </div>
                        <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic" class="vistaImmagine" />
                    
                        <div>
                            <p class="pubblicazione"><?php echo $autore ?> <br />
                            <?php echo $testata; ?></p></div>
                            <?php }
                            ?>
                
                </div>     <!--CHIUSURA DIV rightColumn-->
            
            </div>         <!--CHIUSURA DIV left-->

        
            <!-- colonna destra -->
            <div id="right">
                <img src=<?php echo $movie . "/overview.png"?> alt="general overview"/>
                <div id="areaTestoColonnaDestra">
                    <dl id="testoColonnaDestra">
                        <?php $testo = file($movie ."/overview.txt");       //utilizziamo la funzione file per accedere al file overview.txt e salviamo il valore nella variabile $testo
                        foreach ( $testo as $riga){                   //tramito l'uso di un ciclo foreach che per ogni riga del testo chiama la funzione explode per poter dividere
                        $arr = explode(":", $riga);                   //il file overview.txt di input in due sotto-array che hanno come separatore il carattere ":"
                    ?>
                          
                          <dt class="role"><?php echo $arr[0] ?></dt>
                          <dd><?php echo $arr[1] ?></dd>
                    <?php } 
                    ?>
                    </dl>
                </div>
            </div>          <!--CHIUSURA DIV right-->
        
    
                    <div id="bottom">
                    <?php
                        $arrayFile = glob("$movie/review*.txt");        //tramite la funzione glob recuperiamo tutti i vari file con estensione .txt che contengono le varie recensioni, questo avviene grazie all'uso di una wildcard
                        $lunghezza = count($arrayFile);                 //contiamo la  lunghezza dell'array e salviamo il valore che ci servirà per mostrare il numero totale delle recensioni
                    ?>
                   (1-<?php print $lunghezza;?>) of <?php echo $lunghezza?>

                    </div>
</div>    <!--CHIUSURA DIV main-->  
                    
                    <!--VALIDATORI--> 
                    <div id="validators">
                        <a href="http://validator.w3.org/check/referer"> <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/w3c-xhtml.png" alt="Validate HTML" /></a> <br />
                        <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a>
                    </div>
</body>
</html>