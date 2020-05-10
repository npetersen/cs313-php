<?php

    class Product {
        
        public $productArray = array(
            "qst106" => array(
                'id' => '1',
                'name' => 'Salomon QST 106',
                'code' => 'qst106',
                'image' => 'skis.jpg',
                'price' => '799.99'
            ),
            "blur2020" => array(
                'id' => '2',
                'name' => 'Santa Cruz Blur',
                'code' => 'blur2020',
                'image' => 'mountain-bike.jpg',
                'price' => '899.99'
            ),
            "noah2020" => array(
                'id' => '3',
                'name' => 'Ridley Noah Fast Disc',
                'code' => 'noah2020',
                'image' => 'road-bike.jpg',
                'price' => '999.99'
            )
        );
        
        public function getAllProduct() {
            return $this->productArray;
        }

}
