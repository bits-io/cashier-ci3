<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
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
		if ($this->session->userdata('status_login') != 'login') {
			redirect('Auth');
		}
	}
	public function index()
	{	
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'dashboard' => " active"
		);
		$this->session->set_userdata($data);

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


		$this->load->view('admin/index', $data);
	}
	public function user()
	{	
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'user' => " active",
			'user_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*, produk.id as id');
		$select = $this->db->join('owner', 'owner.id = produk.id_owner');
		$data['read'] = $this->m->Get_All('produk', $select);
		$select = $this->db->select('*');
		$data['user'] = $this->m->Get_All('user', $select);
		$select = $this->db->select('*');
		$data['owner'] = $this->m->Get_All('owner', $select);
		$this->load->view('admin/user', $data);
	}
	public function user_add()
	{
		$data = array(
			'username'		  => $this->input->post('username'),
			'password'	  => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'akses'	  => $this->input->post('akses')

		);
		$this->m->Save($data, 'user');

		redirect('admin/user');
	}
	public function user_update()
	{
		$where = array(
			'username' => $this->input->post('username'),
		);
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'akses' => $this->input->post('akses')
		);
		$this->m->Update($where, $data, 'user');
		redirect('admin/user');
	}
	public function user_delete()
	{
		$where = array(
			'username' => $this->input->post('username')
		);
		$this->m->Delete($where, 'user');
		redirect('admin/user');
	}
	public function kategori()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'kategori' => " active",
			'kategori_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*, kategori.id as id');
		//$select = $this->db->join('owner', 'owner.id = produk.id_owner');

		$data['read'] = $this->m->Get_All('kategori', $select);
		$select = $this->db->select('*');

		//$data['owner'] = $this->m->Get_All('owner', $select);

		$this->load->view('admin/kategori', $data);
	}

	public function tambah_kategori()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'nama' => $this->input->post('nama'),
		);
		$this->m->Save($data, 'kategori');
		redirect('admin/kategori');
	}

	public function ubah_kategori()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->m->Update($where, $data, 'kategori');
		redirect('admin/kategori');
	}

	public function hapus_kategori()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'kategori');
		redirect('admin/kategori');
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
		$select = $this->db->join('kategori', 'kategori.id = produk.id_kategori');

		$data['read'] = $this->m->Get_All('produk', $select);
		$select = $this->db->select('*');

		$data['owner'] = $this->m->Get_All('owner', $select);
		$data['kategori'] = $this->m->Get_All('kategori', $select);

		$this->load->view('admin/produk', $data);
	}
	public function tambah_produk()
	{
		$data = array(
			'id_owner' => $this->input->post('owner'),
			'id_kategori' => $this->input->post('kategori'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
		);
		$this->m->Save($data, 'produk');
		redirect('admin/produk');
	}
	public function ubah_produk()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'id_owner' => $this->input->post('owner'),
			'id_kategori' => $this->input->post('kategori'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
		);
		$this->m->Update($where, $data, 'produk');
		redirect('admin/produk');
	}
	public function hapus_produk()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'produk');
		redirect('admin/produk');
	}
	public function customer()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'customer' => " active",
			'customer_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('customer', $select);
		$this->load->view('admin/customer', $data);
	}
	public function tambah_customer()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'status' => $this->input->post('status'),
		);
		$this->m->Save($data, 'customer');
		redirect('admin/customer');
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
		redirect('admin/customer');
	}
	public function hapus_customer()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'customer');
		redirect('admin/customer');
	}
	public function supplier()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
			'supplier' => " active",
			'supplier_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('supplier', $select);
		$this->load->view('admin/supplier', $data);
	}
	public function tambah_supplier()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->m->Save($data, 'supplier');
		redirect('admin/supplier');
	}
	public function ubah_supplier()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama' => $this->input->post('nama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->m->Update($where, $data, 'supplier');
		redirect('admin/supplier');
	}
	public function hapus_supplier()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'supplier');
		redirect('admin/supplier');
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
		$this->load->view('admin/owner', $data);
	}
	public function tambah_owner()
	{
		$data = array(
			'nama_owner' => $this->input->post('nama_owner'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->m->Save($data, 'owner');
		redirect('admin/owner');
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
		redirect('admin/owner');
	}
	public function hapus_owner()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'owner');
		redirect('admin/owner');
	}
	public function getproduk()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getproduk'] = $this->m->Get_Where($where, 'produk');
		$this->load->view('admin/getproduk', $data);
	}
	public function getkategori()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getkategori'] = $this->m->Get_Where($where, 'kategori');
		$this->load->view('admin/getkategori', $data);
	}
	public function getprdk()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getprdk'] = $this->m->Get_Where($where, 'produk');
		$this->load->view('admin/getprdk', $data);
	}
	public function getcustomer()
	{
		$where = array(
			'id' => $this->input->get('id')
		);

		$data['getcustomer'] = $this->m->Get_Where($where, 'tbl_customer');
		$this->load->view('admin/getcustomer', $data);
	}
	function AddCart($id, $qty)
	{
		$select = $this->db->select('*, produk.id as id_produk');
		$select = $this->db->join('owner', 'owner.id=produk.id_owner');
		$select = $this->db->where('produk.id', $id);
		$getProduk = $this->m->Get_All('produk', $select);
		foreach ($getProduk as $d) {
		}
		$data = array(
			'id'			=> $d->id_produk,
			'name'			=> $d->nama_produk,
			'qty' 			=> $qty,
			'price' 		=> $d->harga_jual,
			'harga_beli' 	=> $d->harga_beli,
			'id_owner'		=> $d->id_owner,
			'nama_owner'	=> $d->nama_owner,
		);
		$this->cart->insert($data);
		$this->ShowCart();
	}
	function AddCartt($id, $qty)
	{
		$select = $this->db->select('*, produk.id as id_produk');
		$select = $this->db->join('owner', 'owner.id=produk.id_owner');
		$select = $this->db->where('produk.id', $id);
		$getprdk = $this->m->Get_All('produk', $select);
		foreach ($getprdk as $d) {
		}
		$data = array(
			'id'			=> $d->id_produk,
			'name'			=> $d->nama_produk,
			'qty' 			=> $qty,
			'price' 		=> $d->harga_jual,
			'harga_beli' 	=> $d->harga_beli,
			'id_owner'		=> $d->id_owner,
			'nama_owner'	=> $d->nama_owner,
		);
		$this->cart->insert($data);
		$this->ShowCartt();
	}
	function ShowCart()
	{
		$output = '';
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .= '
					<tr>
						<td class="text-center">' . $no++ . '.</td>
						<td>' . $items['name'] . '</td>
						<td>Rp<span class="float-right">' . number_format($items['price'], 0, ".", ".") . '</span></td>
						<td class="text-center">' . $items['qty'] . '</td>
						<td>Rp<span class="float-right">' . number_format(($items['qty'] * $items['price']), 0, ".", ".") . '</span></td>
						<td>
							<button type="button" 
							class="btn btn-sm btn-danger cancel-cart" 
							onclick="return batal(`' . $items['rowid'] . '`)">
								<i class="fa fa-times"></i>
							</button>
						</td>
					</tr>
					';
		}
		$output .= '
				<tr>
					<th colspan="4" class="text-center text-bold">Total</th>
					<th colspan="2" class="text-bold">Rp<span class="float-right">' . number_format($this->cart->total(), 0, ".", ".") . '</span></td>
				</tr>
		';

		echo $output;
	}
	function ShowCartt()
	{
		$output = '';
		$no = 1;
		$totba = 0;
		foreach ($this->cart->contents() as $items) {
			$totba += $items['qty'] * $items['harga_beli'];
			$output .= '
					<tr>
						<td class="text-center">' . $no++ . '.</td>
						<td>' . $items['name'] . '</td>
						<td>Rp<span class="float-right">' . number_format($items['harga_beli'], 0, ".", ".") . '</span></td>
						<td class="text-center">' . $items['qty'] . '</td>
						<td>Rp<span class="float-right">' . number_format(($items['qty'] * $items['harga_beli']), 0, ".", ".") . '</span></td>
						<td>
							<button type="button" 
							class="btn btn-sm btn-danger cancel-cart" 
							onclick="return batal(`' . $items['rowid'] . '`)">
								<i class="fa fa-times"></i>
							</button>
						</td>
					</tr>
					';
		}
		$output .= '
				<tr>
					<th colspan="4" class="text-center text-bold">Total</th>
					<th colspan="2" class="text-bold">Rp<span class="float-right">' . number_format($totba, 0, ".", ".") . '</span></td>
				</tr>
		';

		echo $output;
	}
	function DeleteCart($row_id)
	{ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $row_id,
			'qty' => 0,
		);
		$this->cart->update($data);
		$this->ShowCart();
	}
	function DeleteCartt($row_id)
	{ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $row_id,
			'qty' => 0,
		);
		$this->cart->update($data);
		$this->ShowCartt();
	}

	public function SaveTransaksiPenjualan()
	{
		$id		= date('YmdHis');
		$id_customer	= $this->input->post('id_customer');
		$where	= array(
			'id' => $id_customer
		);
		$getCustomer = $this->m->Get_Where($where, 'customer');

		$total_bayar = $this->input->post('total_bayar');
		if ($id_customer == 1) {
			$total_bayar = $this->cart->total();
		}
		foreach ($getCustomer as $c) {
			$data	= array(
				'id'			=> $id,
				'id_customer'	=> $id_customer,
				'nama_customer'	=> $c->nama,
				'waktu'			=> date('Y-m-d H:i:s'),
				'total_bayar'	=> $total_bayar,
				'status'		=> $c->status,
				'kasir'			=> $this->session->userdata('nama'),
			);
			$this->m->save($data, 'ht_penjualan');
		}

		foreach ($this->cart->contents() as $items) {
			$data = array(
				'id'			=> $id,
				'id_produk'		=> $items['id'],
				'nama_produk'	=> $items['name'],
				'id_owner'		=> $items['id_owner'],
				'nama_owner'	=> $items['nama_owner'],
				'harga_beli'	=> $items['harga_beli'],
				'harga_jual'	=> $items['price'],
				'kuantitas'		=> $items['qty'],
			);
			$this->m->save($data, 'dt_penjualan');
			//update stok produk
			$where = array(
				'id'			=> $items['id']
			);
			$getProduk = $this->m->Get_Where($where, 'produk');
			foreach ($getProduk as $p) {
				$data = array(
					'kuantitas' => ($p->kuantitas - $items['qty']),
				);
				$this->m->Update($where, $data, 'produk');
			}
		}
		$this->cart->destroy();
	}

	public function SaveTransaksiPembelian()
	{
		$id = date('YmdHis');
		$id_supplier = $this->input->post('id_supplier');
		$where = array(
			'id' => $id_supplier
		);
		$getSupplier = $this->m->Get_Where($where, 'supplier');

		$totba = 0;
		foreach ($this->cart->contents() as $items) {
			$totba += $items['qty'] * $items['harga_beli'];
		}
		foreach ($getSupplier as $su) {
			//$totba += $items['qty'] * $items['harga_beli'] ;
			$data = array(
				'id' 			=> $id,
				'id_supplier' 	=> $id_supplier,
				'nama_supplier' => $su->nama,
				'waktu'			=> date('Y-m-d H:i:s'),
				'total_bayar'	=> $totba,
			);
			$this->m->save($data, 'ht_pembelian');
		}
		foreach ($this->cart->contents() as $items) {
			$data = array(
				'id' 			=> $id,
				'id_produk' 	=> $items['id'],
				'nama_produk' 	=> $items['name'],
				'harga_beli'	=> $items['harga_beli'],
				'harga_jual'	=> $items['price'],
				'kuantitas'		=> $items['qty'],
			);
			$this->m->save($data, 'dt_pembelian');
			//update stok produk
			$where = array(
				'id'			=> $items['id']
			);
			$getprdk = $this->m->Get_Where($where, 'produk');
			foreach ($getprdk as $p) {
				$data = array(
					'kuantitas' => ($p->kuantitas + $items['qty']),
				);
				$this->m->Update($where, $data, 'produk');
			}
		}
		$this->cart->destroy();
	}

	public function penjualan()
	{
		$this->sidebar();
		$data = array(
			'transaksi' 		=> "open",
			'transaksi_status' 	=> " active",
			'penjualan' 		=> " active",
			'penjualan_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');

		$select = $this->db->select('*,sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));

			$select = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select = $this->db->where('waktu LIKE"' . date('Y-m-d') . '%"');
		}

		$select = $this->db->group_by('ht_penjualan.id');
		$select = $this->db->order_by('waktu', 'DESC');
		$data['read'] = $this->m->Get_All('ht_penjualan', $select);
		
		$select = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select);

		$data['total_bayar'] = 0;
		$data['total_piutang'] = 0;
		$data['total_omset'] = 0;
		foreach ($data['read'] as $r) {
			$data['total_bayar'] += $r->total_bayar;
			$data['total_omset'] += $r->total_omset;
		}
		$data['total_piutang'] = $data['total_omset'] - $data['total_bayar'];

		$data['customer'] = $this->m->Get_All('customer', $select);
		$this->load->view('admin/penjualan', $data);
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

		redirect('admin/penjualan');
	}

	public function penjualan_delete()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$select = $this->db->select('*');
		$getPenjualan = $this->m->Get_Where($where, 'dt_penjualan');
		foreach ($getPenjualan as $p) {
			$where2 = array(
				'id' => $p->id_produk
			);
			$getProduk = $this->m->Get_Where($where2, 'produk');
			foreach ($getProduk as $p2) {
				$data = array(
					'kuantitas' => $p->kuantitas + $p2->kuantitas,
				);
				$this->m->Update($where2, $data, 'produk');
			}
		}

		$this->m->delete($where, ' ht_penjualan');
		$this->m->delete($where, ' dt_penjualan');

		redirect('admin/penjualan');
	}

	public function cetakfakturpenjualan($id)
	{
		$where = array(
			'id' 			=> $id
		);
		$data['ht_penjualan'] = $this->m->Get_Where($where, 'ht_penjualan');
		$data['dt_penjualan'] = $this->m->Get_Where($where, 'dt_penjualan');
		$this->load->view('admin/cetakfakturpenjualan', $data);
	}

	public function LaporanPenjualanRE()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanpenjualanre' 		=> " active",
			'laporanpenjualanre_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-penjualan-re', $data);
	}

	public function LaporanPenjualanOwner()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanpenjualanowner' 		=> " active",
			'laporanpenjualanowner_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$select = $this->db->select('*');
		$select = $this->db->where('id > ' . "1");
		$data['read_owner'] = $this->m->Get_All('owner', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-penjualan-owner', $data);
	}

	public function LaporanPembelianAllSupplier()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanpembelianall' 		=> " active",
			'laporanpembelianall_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-pembelian-all-supplier', $data);
	}

	public function LaporanPembelianPerSupplier()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanpembelianper' 		=> " active",
			'laporanpembelianper_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$select = $this->db->select('*, ht_pembelian.id as id')->join('supplier', 'supplier.id = ht_pembelian.id_supplier');
		$data['read'] = $this->m->Get_All('ht_pembelian', $select);

		$select = $this->db->select('*');
		$data['nama_supplier'] = $this->m->Get_All('supplier', $select);

		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-pembelian-per-supplier', $data);
	}

	public function LaporanPiutangPerTanggal()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanpiutangpertanggal' 		=> " active",
			'laporanpiutangpertanggal_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-piutang-per-tanggal', $data);
	}

	public function CetakLaporanPiutangPerTanggal()
	{
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*,sum(total_bayar) as total_bayar, sum(harga_jual*kuantitas) as total_omset');
		//$select = $this->db->select('*, sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		//$select = $this->db->join('customer', 'ht_penjualan.id_customer=customer.id');
		$select = $this->db->order_by('ht_penjualan.id');
		$select = $this->db->group_by('ht_penjualan.id_customer');
		//$select = $this->db->group_by('customer.id');
		$select = $this->db->where('status = ', "Karyawan");
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		//print_r($data['penjualan']);
		$this->load->view('admin/LaporanPiutangPerTanggal', $data);
	}

	public function CetakLaporanPembelianPerSupplier()
	{
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_supplier', $_GET['id_supplier']);
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$data['nama_supplier']="";
            foreach ($data['pembelian']as $d) {$data['nama_supplier'] = $d->nama_supplier;}
			
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/LaporanPembelianPerSupplier', $data);
	}

	public function CetakLaporanPembelianAllSupplier()
	{
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		//$select = $this->db->where('id_supplier', '1');
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/LaporanPembelianAllSupplier', $data);
	}

	public function CetakLaporanPenjualanRE()
	{
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_owner', '1');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/LaporanPenjualanRE', $data);
	}

	public function CetakLaporanPenjualanOwner()
	{
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_owner', $_GET['id_owner']);
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['nama_owner']="";
            foreach ($data['penjualan']as $d) {$data['nama_owner'] = $d->nama_owner;}
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/LaporanPenjualanOwner', $data);
	}

	public function LaporanPembelianRE($dari, $sampai)
	{
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('ht_pembelian.waktu >="' . $dari . '"');
		$select = $this->db->where('ht_pembelian.waktu <="' . $sampai . '"');
		$select = $this->db->group_by('dt_pembelian.id_produk');
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$this->load->view('admin/LaporanPembelianRE', $data);
	}
	public function cetakfakturpembelian($id)
	{
		$where = array(
			'id' 			=> $id
		);
		$data['ht_pembelian'] = $this->m->Get_Where($where, 'ht_pembelian');
		$data['dt_pembelian'] = $this->m->Get_Where($where, 'dt_pembelian');
		$this->load->view('admin/cetakfakturpembelian', $data);
	}
	public function pembelian()
	{
		$this->sidebar();
		$data = array(
			'transaksi' 		=> "open",
			'transaksi_status' 	=> " active",
			'pembelian' 		=> " active",
			'pembelian_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$select = $this->db->select('*');

		$data['read'] = $this->m->Get_All('ht_pembelian', $select);
		$select = $this->db->select('*');

		$data['produk'] = $this->m->Get_All('produk', $select);

		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$this->load->view('admin/pembelian', $data);
	}
	public function pembelian_delete()
	{
		$id = $this->input->post('id');
		$where = array(
			'id'	=> $id
		);
		$getQty = $this->m->Get_Where($where, 'dt_pembelian');

		foreach ($getQty as $q) {
			$data = array(
				'kuantitas'	=> $q->kuantitas - $this->input->post('qty')
			);
			$where = array(
				'id' => $q->id_produk
			);
			$getProduk = $this->m->Get_Where($where, 'produk');
			foreach ($getProduk as $p) {
				$data = array(
					'kuantitas'	=> ($p->kuantitas - $q->kuantitas)
				);
				$this->m->Update($where, $data, 'produk');
			}
		}

		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->delete($where, ' ht_pembelian');
		$this->m->delete($where, ' dt_pembelian');

		redirect('admin/pembelian');
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
		redirect('admin/pembelian');
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
		redirect('admin/pembelian');
	}
	public function hapus_pembelian()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'pembelian');
		redirect('admin/pembelian');
	}
	public function sidebar()
	{
		$data = array(
			'dashboard' => "",
			'user' => "",
			'user_dot' => "",
			'kategori' => "",
			'kategori_dot' => "",
			'produk' => "",
			'produk_dot' => "",
			'owner' => "",
			'owner_dot' => "",
			'customer' => "",
			'customer_dot' => "",
			'supplier' => "",
			'supplier_dot' => "",
			'penjualan' => "",
			'penjualan_dot' => "",
			'pembelian' => "",
			'pembelian_dot' => "",
			'laporanpenjualanre' => "",
			'laporanpenjualanre_dot' => "",
			'laporanpenjualanowner' => "",
			'laporanpenjualanowner_dot' => "",
			'laporanpembelianall' => "",
			'laporanpembelianall_dot' => "",
			'laporanpembelianper' => "",
			'laporanpembelianper_dot' => "",
			'laporanpiutangpertanggal' => "",
			'laporanpiutangpertanggal_dot' => "",
			'laporanprodukre' => "",
			'laporanprodukre_dot' => "",
			'laporansaldoperiode' => "",
			'laporansaldoperiode_dot' => "",
			'laporandatapemasukanperiode' => "",
			'laporandatapemasukanperiode_dot' => "",
			'laporandatapengeluaranperiode' => "",
			'laporandatapengeluaranperiode_dot' => "",
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
	public function daftar_kategori()
	{
		if ($this->input->get('searchTerm', TRUE)) {
			$data = $this->m->get_kategori_like($this->input->get('searchTerm', TRUE));
		} else {
			$data = $this->m->get_kategori();
		}
		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function LaporanSaldoPeriode()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporansaldoperiode' 		=> " active",
			'laporansaldoperiode_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);

		$select = $this->db->select('*');
		$select = $this->db->where('id > ' . "1");
		$data['read_owner'] = $this->m->Get_All('owner', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-saldo-periode', $data);
	}
	public function CetakLaporanSaldoPeriode()
	{	
		$dari = date('Y-m-d', strtotime($_GET['tahun'].'-'. $_GET['bulan'] . '-' . '00' . ' + 1 days'));
		
		$sampai = date('Y-m-d', strtotime($dari . ' + 1 month - 1 day'));
		// var_dump('dari '.$dari);
		// var_dump('sampai '.$sampai);

		$select1 = $this->db->select('produk.*, produk.kuantitas - sum(dt_pembelian.kuantitas - dt_penjualan.kuantitas) as saldo_akhir');
		$select1 = $this->db->join('dt_penjualan', 'produk.id=dt_penjualan.id_produk');
		$select1 = $this->db->join('dt_pembelian', 'produk.id=dt_pembelian.id_produk')->group_by('produk.id');
		$data['saldo'] = $this->m->Get_All('produk', $select1);
		// var_dump($data['saldo']);

		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "' . $dari . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_owner', '1');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['tanggal'] = $dari;
		$this->load->view('admin/LaporanSaldoPeriode', $data);
	}
	public function LaporanDataPemasukanPeriode()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporandatapemasukanperiode' 		=> " active",
			'laporandatapemasukanperiode_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);
		
		$select = $this->db->select('*');
		$select = $this->db->where('id > ' . "1");
		$data['read_owner'] = $this->m->Get_All('owner', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-data-pemasukan-periode', $data);
	}
	public function CetakLaporanDataPemasukanPeriode()
	{	
		$dari = date('Y-m-d', strtotime($_GET['tahun'].'-'. $_GET['bulan'] . '-' . '00' . ' + 1 days'));
		
		$sampai = date('Y-m-d', strtotime($dari . ' + 1 month - 1 day'));
		

		
		$select1 = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select1);



		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$this->load->view('admin/LaporanDataPemasukanPeriode', $data);
	}
	public function LaporanDataPengeluaranPeriode()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporandatapengeluaranperiode' 		=> " active",
			'laporandatapengeluaranperiode_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);
		
		$select = $this->db->select('*');
		$select = $this->db->where('id > ' . "1");
		$data['read_owner'] = $this->m->Get_All('owner', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('admin/laporan-data-pengeluaran-periode', $data);
	}
	public function CetakLaporanDataPengeluaranPeriode()
	{	
		$dari = date('Y-m-d', strtotime($_GET['tahun'].'-'. $_GET['bulan'] . '-' . '00' . ' + 1 days'));
		
		$sampai = date('Y-m-d', strtotime($dari . ' + 1 month - 1 day'));
		

		
		$select1 = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select1);



		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		
		$this->load->view('admin/LaporanDataPengeluaranPeriode', $data);
	}

	public function LaporanProdukRE()
	{
		$this->sidebar();
		$data = array(
			'laporan' 		=> "open",
			'laporan_status' 	=> " active",
			'laporanprodukre' 		=> " active",
			'laporanprodukre_dot' 	=> "dot-",
		);
		$this->session->set_userdata($data);
		
		$select = $this->db->select('*');
		$data['read_produk'] = $this->m->Get_All('owner', $select);

		$this->load->view('admin/laporan-produk-re', $data);
	}
	public function CetakLaporanProdukRE()
	{	
		$select = $this->db->select('*');
		$select = $this->db->join('owner', 'produk.id_owner=owner.id');
		$select = $this->db->join('kategori', 'produk.id_kategori=kategori.id');
		$data['read_produk'] = $this->m->Get_All('produk', $select);
		

		// error_reporting(0);
		
		$this->load->view('admin/LaporanProdukRE', $data);
	}
}

