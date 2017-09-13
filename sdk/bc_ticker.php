<?php
include('create_table.php');
    /*
        -Classe 
        Ticker - Objetivo: Responsavel por armazenar e inserir as informacoes de um ticker.
        -Parametros
        high: Maior preço unitário de negociação das últimas 24 horas.
        Tipo: Decimal
        low: Menor preço unitário de negociação das últimas 24 horas.
        Tipo: Decimal
        vol: Quantidade negociada nas últimas 24 horas.
        Tipo: Decimal
        last: Preço unitário da última negociação.
        Tipo: Decimal
        buy: Maior preço de oferta de compra das últimas 24 horas.
        Tipo: Decimal
        sell: Menor preço de oferta de venda das últimas 24 horas.
        Tipo: Decimal
        date: Data e hora da informação em Era Unix 
        Tipo: Inteiro
    */
    class Ticker{
        public $high = 0.0;
        public $low = 0.0;
        public $vol = 0.0;
        public $last = 0.0;
        public $buy = 0.0;
        public $date = "";
        public $date_unix = 0;
        protected $json; 
        protected $obj;
        // Construtor
        public function __construct(){
            $this->json = file_get_contents('https://www.mercadobitcoin.net/api/v2/ticker/');
            $this->obj = json_decode($this->json);
            $ticker = $this->obj->ticker;
            $this->high = $ticker->high;
            $this->low =  $ticker->low;
            $this->vol =  $ticker->vol;
            $this->last =  $ticker->last;
            $this->buy =  $ticker->buy;
            $this->date_unix = $ticker->date;
            $this->date = gmdate("Y-m-d\ H:i:s",$this->date_unix);
            $this->save();
        }
        // Imprime as informacoes
        public function info(){
            echo "High:".$this->high.", Created on: ".$this->date."\n";
        }

        // Salva no banco de dados
        protected function save(){
            global $conn;
            $sql = "INSERT INTO TICKER (high, low, vol, last, buy, date)
            VALUES($this->high, $this->low, $this->vol, $this->last, $this->buy, $this->date_unix)";
            if ($conn->query($sql)==TRUE) {
                echo "New record created successfully\n";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn)."\n";
            }
        }
        
        public function getDate($date):Ticker{
            $sql = "SELECT * FROM TICKER where (date > $sdate-5) AND (date < $date+5) order by date asc limit 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $this->high = $row['high'];
               $this->low =  $row['low'];
               $this->vol =  $row['vol'];
               $this->last =  $row['last'];
               $this->buy =  $row['buy'];
               $this->date_unix = $row['date'];
               $this->date = gmdate("Y-m-d\ H:i:s",$this->date_unix);
            }
            else {
                echo "We dont have any record about that date.\n";
            }
        }
        public function getPeriod($date_b,$date_e){
            
            $sql = "SELECT * FROM TICKER where (date > $sdate-5) AND (date < $date+5) order by date asc limit 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $this->high = $row['high'];
               $this->low =  $row['low'];
               $this->vol =  $row['vol'];
               $this->last =  $row['last'];
               $this->buy =  $row['buy'];
               $this->date_unix = $row['date'];
               $this->date = gmdate("Y-m-d\ H:i:s",$this->date_unix);
            }
            else {
                echo "We dont have any record about that date.\n";
            }
        }
    }

    
?>