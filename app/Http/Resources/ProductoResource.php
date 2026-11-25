<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nombre'    => $this->nombre,
            'descripcion'    => $this->descripcion ?? '',
            // Formateo del precio en Lempiras para la interfaz de usuario
            'precio'         => (float) $this->precio_venta,
            'precio_hnl'     => 'L. ' . number_format($this->precio_venta, 2),
            'stock'          => (int) $this->stock,
            'disponibilidad' => $this->stock > 0 ? 'En Existencia' : 'Agotado',
            // Ocultamos intencionalmente costo_compra y campos sensibles del proveedor
        ];
    }
}
