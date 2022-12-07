<?php 
class Carrito01 {
    private $_mesa=null;

    public function __construct($mesa)
    {
        $this->_mesas=$mesa;
    }
    public function agregar($idProducto,$cant=1){
        if (!isset($this->_mesa[$idProducto]))
            $this->_mesa[$idProducto]['cant']=0;       #inicializamos por lo menos 'cant'
        $this->_mesa[$idProducto]['cant'] += $cant;    #Agregamos la Cantidad
    }
    public function sacar($idProducto,$cant=1){
        if ($cant<=$this->_mesa[$idProducto]['cant'])
            $this->_mesa[$idProducto]['cant']-= $cant;
        if ($this->_mesa[$idProducto]['cant']==0)
            unset($this->_mesa[$idProducto]);
    }
    public function getMesa(){
        return $this->_mesa;
    }
    public function getCantidad($idProducto){
        return isset($this->_mesa[$idProducto]['cant'])?$this->_mesa[$idProducto]['cant']:0;
    }
    /*public function calcularTotal(){
        $total = 0;
        foreach ($this->_mesa as $p) 
            $total += $p['precio'] * $p['cant'] ;
        $total = number_format($total,2,"."," ");
        return $total;
    }
    */
    public function getNroProductos(){
        $nro=0;
        if (is_array($this->_mesa))
        foreach ($this->_mesa as $p) {
            $nro += $p['cant'];
        }
        return $nro;
    }
}