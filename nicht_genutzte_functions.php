<?php
/*----------------------------------------------------------------*/
/* Start: Länge des Beitragsauszugs einstellen 
/* funktioniert nicht richtig, weil die Beiträge bereits in den meisten Fällen einen manuell erfassten Auszug haben 
/* Datum: 10.11.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
//Excerpt Länge ändern
function custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/*----------------------------------------------------------------*/
/* Start: Länge des Beitragsauszugs einstellen 
/* Datum: 10.11.2018
/* Autor: hgg
/*----------------------------------------------------------------*/

?>