<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cobranzas_model extends CI_Model
{
	//este metodo es para mostrar todas las cobranzas
	public function getCobranzas()
	{
		$this->db->select("cb.*, cb.estado cobro_estado, vs.*, cl.razonsocial, fp.descripcion as formadepago");
		$this->db->from("cobros cb");
		$this->db->join("ventas vs", "vs.id_venta=cb.id_venta");
		$this->db->join("clientes cl", "cl.id_cliente=vs.id_cliente");
		$this->db->join("formas_pago fp", "fp.id_formapago=cb.id_formapago");
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

	//este metodo es para mostrar los datos de una cobranza
	public function getCobranza($id)
	{
		$this->db->select("cb.*, fp.descripcion as formadepago");
		$this->db->from("cobros cb");
		$this->db->join("formas_pago fp", "fp.id_formapago=cb.id_formapago");
		$this->db->where('id_cobro', $id);
		
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function getCobranzaByVenta($id_venta)
	{
		$this->db->select("cb.*, cb.estado cobro_estado, fp.descripcion as formadepago");
		$this->db->from("cobros cb");
		$this->db->join("formas_pago fp", "fp.id_formapago=cb.id_formapago");
		$this->db->where(['id_venta' => $id_venta]);
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("cobros", $data);
	}

	//esta es la parte para guardar en la bd
	public function lastID()
	{
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where("id_cobro", $id);
		return $this->db->update("cobros", $data);
	}

	public function getPagos($id_venta, $id_cobro = '')
	{
		if(!empty($id_cobro)){
			$where = ['id_venta' => $id_venta, 'id_cobro <> ' => $id_cobro];
		}else{
			$where = ['id_venta' => $id_venta];
		}

		$this->db->select("cb.monto");
		$this->db->from("cobros cb");
		$this->db->where($where);
		$resultados = $this->db->get();
		
		$sum = 0;
		foreach ($resultados->result() as $res) {
			$sum += $res->monto;
		}
		return $sum;
	}
}
