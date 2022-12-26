<?php

class InfoBnr
{
    private $UrlBnr         = "https://www.bnr.ro/nbrfxrates.xml";
    private $XMLContent     = "";
    private $Valute         = array();

    public function __construct()
    {
        $this->get_content();
        $this->parse_valute();
    }

    public function getCursPentruValuta($codValuta)
    {
        if(!empty($this->Valute[$codValuta])) {
            return $this->Valute[$codValuta];
        } else {
            return 0;
        }
    }

    private function get_content()
    {
        $this->XMLContent = file_get_contents($this->UrlBnr);
    }

    private function parse_valute()
    {
        $dom = new DOMDocument();
        $dom->loadXML($this->XMLContent);

        foreach($dom->getElementsByTagName('Rate') as $valuta)
        {
            $codValuta  = $valuta->getAttribute('currency');
            $valoare    = floatval($valuta->nodeValue);

            $this->Valute[$codValuta] = $valoare;
        }
    }
}