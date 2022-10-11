<?php

abstract class Libreria {
    static function getMenu(){
        return array(
            array(
                'icono'=>'globe',
                'enlace'=>'CtrlCategoria',
                'texto'=>'Categoria'
            ),
            array(
                'icono'=>'city',
                'enlace'=>'CtrlMesa',
                'texto'=>'Mesas'
            ),
            array(
                'icono'=>'users',
                'enlace'=>'CtrlUsuario',
                'texto'=>'Usuarios'
            ),
            array(
                'icono'=>'users',
                'enlace'=>'CtrlProducto',
                'texto'=>'Producto'
            ),
            array(
                'icono'=>'users',
                'enlace'=>'CtrlCliente',
                'texto'=>'Cliente'
            ),
            array(
                'icono'=>'users',
                'enlace'=>'CtrlReserva',
                'texto'=>'Reservas'
            ),
            array(
                'icono'=>'users',
                'enlace'=>'CtrlPedido',
                'texto'=>'Pedido'
            ),
        );
    }
}
