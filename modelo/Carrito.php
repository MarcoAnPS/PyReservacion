<?php 
class Carrito {
    private $_productos=null;
/*
    public function agregar($idMesa, $idProducto,$cant=1){
        if (!isset($this->_mesa[$idMesa]))
            $this->_mesa[$idMesa][$idProducto]['cant']=0;       #inicializamos por lo menos 'cant'
        $this->_mesa[$idMesa][$idProducto]['cant'] += $cant;    #Agregamos la Cantidad
    }
*/
    public function agregar($idProducto,$cant=1,$precio=0){
        if (!isset($this->_productos[$idProducto]))
            $this->_productos[$idProducto]['cant']=0;       #inicializamos por lo menos 'cant'
        $this->_productos[$idProducto]['cant'] += $cant;    #Agregamos la Cantidad
        $this->_productos[$idProducto]['precio'] = $precio;    #Agregamos el Precio
    }
    
    // public function agregarMesa($idMesa,$cant=1){
    //     if (!isset($this->_mesas[$idMesa]))
    //         $this->_mesas[$idMesa]['Numero']=0;       #inicializamos por lo menos 'cant'
    //     $this->_mesas[$idMesa]['Numero'] += $cant;    #Agregamos la Cantidad
    // }
    public function sacar($idProducto,$cant=1){
        if ($cant<=$this->_productos[$idProducto]['cant'])
            $this->_productos[$idProducto]['cant']-= $cant;
        if ($this->_productos[$idProducto]['cant']==0)
            unset($this->_productos[$idProducto]);
    }
    /*
    public function sacar($idMesa, $idProducto,$cant=1){
        if ($cant<=$this->_mesa[$idMesa][$idProducto]['cant'])
            $this->_mesa[$idMesa][$idProducto]['cant']-= $cant;
        if ($this->_mesa[$idMesa][$idProducto]['cant']==0)
            unset($this->_mesa[$idMesa][$idProducto]);
    }
    */
    public function getProductos(){
        return $this->_productos;
    }
    public function getCantidad($idProducto){
        return isset($this->_productos[$idProducto]['cant'])?$this-_productos[$idProducto]['cant']:0;
    }
    
    public function calcularTotal(){
        $total = 0;
        foreach ($this->_productos as $p) 
            $total += $p['precio'] * $p['cant'] ;
        $total = number_format($total,2,"."," ");
        return $total;
    }
    
    public function getNroProductos(){
        $nro=0;
        if (is_array($this->_productos))
        foreach ($this->_productos as $p) {
                    $nro += $p['cant'];
        }
        return $nro;
    }
    
}