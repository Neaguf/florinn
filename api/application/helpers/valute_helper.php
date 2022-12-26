<?php
/**
 * Created by PhpStorm.
 * User: danadrianlutescu
 * Date: 26/09/2019
 * Time: 19:32
 */

include "./application/helpers/bnr_helper.php";

class ValuteHelper
{
    public function get_valuta_infovalutar($data, $valuta)
    {
        
        $an     = date("Y", strtotime($data));
        $luna   = date("m", strtotime($data));
        $zi     = date("d", strtotime($data)); 
        $valuta = strtolower($valuta);
        
        if( $valuta == "ron" ) return 1;

        $url    = "http://www.infovalutar.ro/{$an}/{$luna}/{$zi}/{$valuta}.bnr";
        
        return file_get_contents($url);
    }

    public static function get_valute($data='')
    {
        $ret    = array();
        $valute = DbValuteModel::query()->get();
        if($data == '' ) $data   = date("Y-m-d");

        $cursuri_locale_query   = DbCursValutarModel::query()->where("DataCurs", date('Y-m-d',strtotime($data)))->get();
        $cursuri_locale         = array();

        foreach ($cursuri_locale_query as $cl)
        {
            $cursuri_locale[$cl->AbreviereValuta] = $cl->Valoare;
        }
        $preiau_de_pe_bnr = false;

        if (count($cursuri_locale) > 0) {
            foreach ($valute as $v) {
                if ($v->Abreviere != 'RON') {
                    if (array_key_exists($v->Abreviere, $cursuri_locale))
                        $ret[$v->Abreviere] = $cursuri_locale[$v->Abreviere];
                    else {
                        //echo 'nu am gasit valuta ' . $v->Abreviere;
                        $preiau_de_pe_bnr = true;
                    }
                }
            }
        } 
        else 
        {
            //echo "nu am cursuri locale <br/>";
            $preiau_de_pe_bnr = true;
        }

        if ($preiau_de_pe_bnr) 
        {
            $infoBnr = new InfoBnr();

            foreach($valute as $v)
            {
                $v->ValutaLowerCase = strtolower( $v->Abreviere );
                $year   = date("Y", strtotime($data));
                $month  = date("m", strtotime($data));
                $day    = date("d", strtotime($data));
                $url    = "http://www.infovalutar.ro/{$year}/{$month}/{$day}/{$v->ValutaLowerCase}.bnr";
                $value  = @file_get_contents($url);
                
                if(!empty($value)) {
                    $ret[$v->Abreviere] = $value;
                } else {
                    $ret[$v->Abreviere] = $infoBnr->getCursPentruValuta($v->Abreviere);
                }
            }
            
            //salvam in db
            foreach ($ret as $abreviere => $value)
            {
                $cc = new DbCursValutarModel();
                $cc->Valoare         = $value;
                $cc->AbreviereValuta = $abreviere;
                $cc->DataCurs        = $data;
                $cc->Insert();
            }

        }

        $ret['RON'] = '1';

        return $ret;
    }

    public static function get_suma_in_euro($valute, $suma, $valuta)
    {

        if ($valuta == 'EUR') return $suma;

        //daca e in orice currency, transformam in lei si apoi in euro
        $in_lei = doubleval($valute[$valuta]) * doubleval($suma);
        if( $valute['EUR'] > 0 ){
            $in_euro = $in_lei / doubleval($valute['EUR']);
            $in_euro = round($in_euro, 2);
        }else{
            $in_euro = $in_lei;
        }
        return $in_euro;
    }

    public static function get_suma_in_Lei($valute, $suma, $valuta)
    {
        if ($valuta == 'LEI') return $suma;

        //daca e in orice currency, transformam in lei
        $in_lei  = doubleval($valute[$valuta]) * doubleval($suma);

        return $in_lei;
    }
}