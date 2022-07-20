<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kasir extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
	}
	public function index()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');

		$select1 = $this->db->select('sum(harga_jual) as total_jual');
		$select1 = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id', 'left');
		
		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));

			$select1 = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select1 = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select1 = $this->db->where('waktu LIKE"' . date('Y-m-d') . '%"');
		}
		$penjualan = $this->m->Get_All('ht_penjualan', $select1);
		$data['penjualan'] = 0;
		foreach($penjualan as $p){$data['penjualan'] = $p->total_jual; }


		$select2 = $this->db->select('sum(harga_beli) as total_beli');

		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));

			$select1 = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select1 = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select1 = $this->db->where('waktu LIKE"' . date('Y-m-d') . '%"');
		}
		$select1 = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id', 'left');
		$penjualan = $this->m->Get_All('ht_pembelian', $select2);
		$data['pembelian'] = 0;
		foreach($penjualan as $p){$data['pembelian'] = $p->total_beli; }
	
		
		$data['laba'] =$data['penjualan'] - $data['pembelian'];
		

		$this->load->view('kasir/index', $data);
	}
	public function produk()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'produk' => " active",
			'produk_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*, produk.id as id');
		$select = $this->db->join('owner', 'owner.id = produk.id_owner');
		$data['read'] = $this->m->Get_All('produk', $select);

		$select = $this->db->select('*');
		$data['owner'] = $this->m->Get_All('owner', $select);
		
		$this->load->view('kasir/produk', $data);
	}
	public function tambah_produk()
	{
		$data = array(
			'id_owner' => $this->input->post('owner'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
		);
		$this->m->Save($data, 'produk');
		redirect('kasir/produk');
	}
	public function ubah_produk()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'id_owner' => $this->input->post('owner'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
		);
		$this->m->Update($where, $data, 'produk');
		redirect('kasir/produk');
	}
	public function hapus_produk()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'produk');
		redirect('kasir/produk');
	}
	public function customer()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'owner' => " active",
			'owner_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('customer', $select);
		$this->load->view('kasir/customer', $data);
	}
	public function tambah_customer()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'status' => $this->input->post('status'),
		);
		$this->m->Save($data, 'customer');
		redirect('kasir/customer');
	}
	public function ubah_customer()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama' => $this->input->post('nama'),
			'status' => $this->input->post('status'),
		);
		$this->m->Update($where, $data, 'customer');
		redirect('kasir/customer');
	}
	public function hapus_customer()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'customer');
		redirect('kasir/customer');
	}
	public function owner()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'owner' => " active",
			'owner_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('owner', $select);
		$this->load->view('kasir/owner', $data);
	}
	public function tambah_owner()
	{
		$data = array(
			'nama_owner' => $this->input->post('nama_owner'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->m->Save($data, 'owner');
		redirect('kasir/owner');
	}
	public function ubah_owner()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama_owner' => $this->input->post('nama_owner'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->m->Update($where, $data, 'owner');
		redirect('kasir/owner');
	}
	public function hapus_owner()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'owner');
		redirect('kasir/owner');
	}
	public function getproduk()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getproduk'] = $this->m->Get_Where($where, 'tbl_produk');
		$this->load->view('kasir/getproduk', $data);
	}
	public function getcustomer()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getcustomer'] = $this->m->Get_Where($where, 'tbl_customer');
		$this->load->view('kasir/getcustomer', $data);
	}
	function AddCart($id,$qty){
		$where = array(
			'id' => $id
		);
		$getProduk = $this->m->Get_Where($where, 'produk');
		foreach($getProduk as $d){}
		$data = array(
			'id'			=> $d->id, 
			'name'			=> $d->nama_produk, 
			'qty' 			=> $qty, 
			'price' 		=> $d->harga_jual, 
			'harga_beli' 	=> $d->harga_beli, 
		);
		$this->cart->insert($data);
		$this->ShowCart();
	}
	function ShowCart(){ 
		$output = '';
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .='
					<tr>
						<td>'.$items['name'].'</td>
						<td>'.$items['price'].'</td>
						<td>'.$items['qty'].'</td>
						<td>'.($items['qty']*$items['price']).'</td>
						<td><button type="button"
                                                    class="btn btn-sm btn-danger cancel-cart"
                                                    onclick="return batal(`'.$items['rowid'].'`)">
                                                        <i class="fa fa-times"></i>
                                                    </button></td>
					</tr>
					';
		}
		$output .= '
				<tr>
					<th colspan="4">Total</th>
					<th>$'.number_format($this->cart->total()).'</td>
					
				</tr>
		';	
		
		echo $output;
	}
	function DeleteCart($row_id){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $row_id,
			'qty' => 0, 
		);
		$this->cart->update($data);
		$this->ShowCart();
	}

	public function SaveTransaksiPenjualan()
	{
		$id = date('YmdHis');
		$id_customer = $this->input->post('id_customer');
		$where = array(
			'id' => $id_customer
		);
		$getCustomer = $this->m->Get_Where($where, 'customer');
		
		foreach($getCustomer as $c){
			$data = array(
				'id' 			=> $id,
				'id_customer' 	=> $id_customer,
				'nama_customer' => $c->nama,
				'waktu'			=> date('Y-m-d H:i:s'),
				'total_bayar'	=> $this->cart->total(),
				'status'			=> $this->session->userdata('username'),
			);
			$this->m->save($data, 'ht_penjualan');
		}		
	}

	public function penjualan()
	{
		$this->sidebar();
		$data = array(
			'transaksi' => "open",
			'transaksi_status' => " active",
			'penjualan' => " active",
			'penjualan_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$select = $this->db->select('*');

		$data['read'] = $this->m->Get_All('ht_penjualan', $select);
		$select = $this->db->select('*');

		$data['produk'] = $this->m->Get_All('produk', $select);

		$data['customer'] = $this->m->Get_All('customer', $select);
		$this->load->view('kasir/penjualan', $data);
	}
	public function tambah_penjualan()
	{
		$data = array(
			'id_produk' 	=> $this->input->post('id_produk'),
			'nama_produk' 	=> $this->input->post('nama_produk'),
			'harga_beli' 	=> $this->input->post('harga_beli'),
			'harga_jual' 	=> $this->input->post('harga_jual'),
			'qty' 			=> $this->input->post('qty'),
			'tanggal' 		=> $this->input->post('tanggal'),
		);
		$this->m->Save($data, 'penjualan');

		redirect('kasir/penjualan');
	}
	public function ubah_penjualan()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'id_produk' 	=> $this->input->post('id_produk'),
			'nama_produk' 	=> $this->input->post('nama_produk'),
			'harga_beli' 	=> $this->input->post('harga_beli'),
			'harga_jual' 	=> $this->input->post('harga_jual'),
			'qty' 	=> $this->input->post('qty'),
			'tanggal' 		=> $this->input->post('tanggal'),
		);
		$this->m->Update($where, $data, 'tbl_penjualan');

		redirect('kasir/penjualan');
	}
	public function hapus_penjualan()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'penjualan');
		redirect('kasir/penjualan');
	}
	public function pembelian()
	{
		$this->sidebar();
		$data = array(
			'transaksi' => "open",
			'transaksi_status' => " active",
			'pembelian' => " active",
			'pembelian_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*, pembelian.id as id');
		$select = $this->db->join('produk', 'produk.id = pembelian.id_produk');
		$data['read'] = $this->m->Get_All('pembelian', $select);
		$select = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select);
		$this->load->view('kasir/pembelian', $data);
	}
	public function tambah_pembelian()
	{
		$data = array(
			'id_produk' 	=> $this->input->post('id_produk'),
			'nama_produk' 	=> $this->input->post('nama_produk'),
			'harga_beli' 	=> $this->input->post('harga_beli'),
			'harga_jual' 	=> $this->input->post('harga_jual'),
			'qty' 			=> $this->input->post('qty'),
			'tanggal' 		=> $this->input->post('tanggal'),
		);
		$this->m->Save($data, 'pembelian');
		redirect('kasir/pembelian');
	}
	public function ubah_pembelian()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'id_produk' 	=> $this->input->post('id_produk'),
			'nama_produk' 	=> $this->input->post('nama_produk'),
			'harga_beli' 	=> $this->input->post('harga_beli'),
			'harga_jual' 	=> $this->input->post('harga_jual'),
			'qty' 	=> $this->input->post('qty'),
			'tanggal' 		=> $this->input->post('tanggal'),
		);
		$this->m->Update($where, $data, 'tbl_pembelian');
		redirect('kasir/pembelian');
	}
	public function hapus_pembelian()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'pembelian');
		redirect('kasir/pembelian');
	}
	public function sidebar()
	{
		$data = array(
			'dashboard' => "",
			'produk' => "",
			'produk_dot' => "",
			'owner' => "",
			'owner_dot' => "",
			'penjualan' => "",
			'penjualan_dot' => "",
			'master' => "close",
			'master_status' => "",
			'transaksi' => "close",
			'transaksi_status' => "",
			'laporan' => "close",
			'laporan_status' => "",
		);
		$this->session->set_userdata($data);
	}
	public function daftar_owner()
	{
		if ($this->input->get('searchTerm', TRUE)) {
			$data = $this->m->get_owner_like($this->input->get('searchTerm', TRUE));
		} else {
			$data = $this->m->get_owner();
		}
		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}
}
