<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yonetici extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('yonetici_model');
	}

	public function kullanici_grubu()
	{
		$data['gruplar'] = $this->yonetici_model->tum_gruplari_getir();
		$this->load->view('include/header');
		$this->load->view('yonetici/kullanici-grubu', $data);
		$this->load->view('include/footer');
	}

	public function kullanici_grubu_ekle()
	{
		$grup_adi = $this->input->post('grup_adi');
		$aciklama = $this->input->post('aciklama');

		$this->yonetici_model->grup_ekle($grup_adi, $aciklama);
		redirect('yonetici/kullanici_grubu');
	}

	public function kullanici_grubu_sil($id)
	{
		$this->yonetici_model->grup_sil($id);
		redirect('yonetici/kullanici_grubu');
	}
}
?>

<!-- existing code -->
<div class="container mt-4">
    <h3>Kullanıcı Grupları</h3>
    <form action="<?= base_url('yonetici/kullanici_grubu_ekle'); ?>" method="post" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="grup_adi" class="form-control" placeholder="Grup Adı" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="aciklama" class="form-control" placeholder="Açıklama">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Grup Ekle</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Grup Adı</th>
                <th>Açıklama</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($gruplar as $grup): ?>
                <tr>
                    <td><?= $grup->grup_adi; ?></td>
                    <td><?= $grup->aciklama; ?></td>
                    <td>
                        <!-- Sil ve düzenle butonları eklenebilir -->
                        <a href="<?= base_url('yonetici/kullanici_grubu_sil/'.$grup->id); ?>" class="btn btn-danger btn-sm">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- existing code -->