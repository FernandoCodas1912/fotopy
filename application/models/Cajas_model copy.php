<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cajas_model extends CI_Model
{

  var $table = 'cajas';
  var $IdTable = 'id_caja';
  var $column = array('v.IdVenta', 'v.Fecha', 'c.RazonSocial', 'v.NroComprobante'); //columnas de busqueda
  var $order = array('IdVenta' => 'desc');

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->search = '';
  }

  private function _get_datatables_query()
  {

    $this->db->select("v.*, c.RazonSocial as Cliente,f.Descripcion as FormaPago, t.Descripcion as Comprobante");
    $this->db->from("venta v");
    $this->db->join("cliente c", "c.IdCliente=v.IdCliente");
    $this->db->join("formapago f", "f.IdFormaPago=v.IdFormaPago");
    $this->db->join("tipocomprobante t", "t.IdTipoComprobante=v.TipoComprobante");


    $i = 0;

    foreach ($this->column as $item) {
      if ($_POST['search']['value']) ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
      $column[$i] = $item;
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  //esta es la parte para guardar en la bd
  public function save_apertura($data)
  {
    return $this->db->insert("ape_cie_caja", $data);
    //return $this->db->update("cliente", $data);
  }

  //esto es para actualizar
  public function updatedetalle($id, $data)
  {
    $this->db->where($this->IdTable, $id);
    return $this->db->update("detalleventa", $data);
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    $this->db->where("v.EstadoVenta", '1');
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function get_by_id($id)
  {
    $this->db->select("v.*, c.RazonSocial as Cliente, c.NroDocumento, c.Telefono, c.Direccion,f.Descripcion as formadepago, t.Descripcion as Comprobante ");
    $this->db->from("venta v");
    $this->db->join("cliente c", "c.IdCliente=v.IdCliente");
    $this->db->join("tipocomprobante t", "t.IdTipoComprobante=v.TipoComprobante");
    $this->db->join("formapago f", "f.IdFormaPago=v.IdFormaPago");
    $this->db->where("v.IdVenta", $id);
    $this->db->where("v.EstadoVenta", '1');

    $query = $this->db->get();
    return $query->row();
  }

  public function getDetalleVenta($id)
  {
    $this->db->select("dv.*, p.IdProducto, p.Codigo as Codigo, p.Impuesto, p.Nombre as Producto");
    $this->db->from("detalleventa dv");
    $this->db->join("producto p", "p.IdProducto=dv.IdProducto"); //modifico marcelo
    $this->db->where("dv.IdVenta", $id); //modifico marcelo
    //$this->db->where("dm.id_movimiento",$id);
    $resultados = $this->db->get();
    return $resultados->result();
  }


  public function getAll()
  {
    $this->db->from($this->table);
    $query = $this->db->get();
    return $query->result();
  }
  public function todos($tabla, $where)
  {
    $this->db->select("*");
    $this->db->from($tabla);
    $this->db->where($where);
    $resultados = $this->db->get();
    return $resultados->result();
  }

  public function save($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function lastID()
  {
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id, $data)
  {
    $this->db->where($this->IdTable, $id);
    //  $this->db->delete($this->table);
    return  $this->db->update('ape_cie_caja', $data);
  }
  public function delete_by_id_det($id, $data)
  {
    $this->db->where($this->IdTable, $id);
    //  $this->db->delete($this->table);
    return  $this->db->update("detalleventa", $data);
  }
  public function getReporte($where)
  {
    $this->db->select("v.Fecha, v.Total, v.SerieComprobante, v.NroComprobante, tc.Descripcion as TipoComprobante, c.RazonSocial, u.Username, f.Descripcion");
    $this->db->from("venta v");
    $this->db->join("cliente c", "c.IdCliente=v.IdCliente");
    $this->db->join("usuario u", "v.IdUsuario=u.IdUsuario");
    $this->db->join("tipocomprobante tc", "v.TipoComprobante=tc.IdTipoComprobante");
    $this->db->join("formapago f", "f.IdFormaPago=v.IdFormaPago");
    $this->db->where($where);
    $resultados = $this->db->get();
    return $resultados->result();
  }
}
