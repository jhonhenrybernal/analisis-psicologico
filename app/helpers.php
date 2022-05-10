<?php

    /**
     * @author Jhon Bernal
     * @description genera dinamicamente un valor de tipo string
     * @param $cant cantidad de caracteres que se quieren ver
     * @param $type clasificar si es texto o numero
     */
    function generateValueDinamic($cant,$type)
    {
        if ($type=='numero') { 
        $characters = '123456789';
        }else if ($type=='texto') {
           $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
        }else if ($type=='texto-numero') {
           $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        }
   
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $cant; $i++) {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
        return $randomString;
   }