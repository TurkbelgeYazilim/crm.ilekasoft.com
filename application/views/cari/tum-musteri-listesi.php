<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $baslik; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Cari</li>
                        <li class="breadcrumb-item active">Tüm Müşteri Listesi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tüm Müşteri Listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <form method="get" action="<?php echo base_url('cari/tum-musteri-listesi'); ?>">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cariKodu">Cari Kodu</label>
                                                    <input type="text" class="form-control" id="cariKodu" name="cariKodu" value="<?php echo $this->input->get('cariKodu'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cariAdi">Cari Adı</label>
                                                    <input type="text" class="form-control" id="cariAdi" name="cariAdi" value="<?php echo $this->input->get('cariAdi'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="bireysel">Cari Tipi</label>
                                                    <select class="form-control" id="bireysel" name="bireysel">
                                                        <option value="">Tümü</option>
                                                        <option value="true" <?php echo ($this->input->get('bireysel') == 'true') ? 'selected' : ''; ?>>Bireysel</option>
                                                        <option value="false" <?php echo ($this->input->get('bireysel') == 'false') ? 'selected' : ''; ?>>Kurumsal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="islemYapan">İşlem Yapan</label>
                                                    <select class="form-control" id="islemYapan" name="islemYapan">
                                                        <option value="">Tümü</option>
                                                        <?php
                                                        $kullanicilar = $this->db->get('kullanicilar')->result();
                                                        foreach ($kullanicilar as $kullanici) {
                                                            $selected = ($this->input->get('islemYapan') == $kullanici->kullanici_id) ? 'selected' : '';
                                                            echo '<option value="' . $kullanici->kullanici_id . '" ' . $selected . '>' . $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="bulunduguIl">Bulundugu İl</label>
                                                    <select class="form-control" id="bulunduguIl" name="bulunduguIl">
                                                        <option value="">Tümü</option>
                                                        <?php
                                                        $iller = $this->db->get('iller')->result();
                                                        foreach ($iller as $il) {
                                                            $selected = ($this->input->get('bulunduguIl') == $il->id) ? 'selected' : '';
                                                            echo '<option value="' . $il->id . '" ' . $selected . '>' . $il->il . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tarihAraligi">Tarih Aralığı</label>
                                                    <div class="input-group date" id="tarihAraligi" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#tarihAraligi" name="tarihAraligi" value="<?php echo $this->input->get('tarihAraligi'); ?>">
                                                        <div class="input-group-append" data-target="#tarihAraligi" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary">Filtrele</button>
                                                <a href="<?php echo base_url('cari/tum-musteri-listesi'); ?>" class="btn btn-secondary">Sıfırla</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Toplam Müşteri Sayısı: <?php echo $count_of_list; ?></h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Cari Kodu</th>
                                                        <th>Cari Adı</th>
                                                        <th>Cari Soyadı</th>
                                                        <th>Cari Tipi</th>
                                                        <th>Vergi No</th>
                                                        <th>İşlem Yapan</th>
                                                        <th>İl</th>
                                                        <th>İlçe</th>
                                                        <th>Telefon</th>
                                                        <th>E-posta</th>
                                                        <th>Durum</th>
                                                        <th>İşlemler</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($cari as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->cari_id; ?></td>
                                                        <td><?php echo $item->cari_kodu; ?></td>
                                                        <td><?php echo $item->cari_ad; ?></td>
                                                        <td><?php echo $item->cari_soyad; ?></td>
                                                        <td><?php echo ($item->cari_bireysel) ? 'Bireysel' : 'Kurumsal'; ?></td>
                                                        <td><?php echo $item->cari_vergiNumarasi; ?></td>
                                                        <td>
                                                            <?php
                                                            $kullanici = $this->db->get_where('kullanicilar', array('kullanici_id' => $item->cari_olusturan))->row();
                                                            echo $kullanici ? $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad : 'Bilinmiyor';
                                                            ?>
                                                        </td>
                                                        <td><?php echo $item->il_adi; ?></td>
                                                        <td><?php echo $item->ilce_adi; ?></td>
                                                        <td><?php echo $item->cari_firmaTelefon; ?></td>
                                                        <td><?php echo $item->cari_firmaEPosta; ?></td>
                                                        <td>
                                                            <span class="badge badge-<?php echo $item->cari_durum ? 'success' : 'danger'; ?>">
                                                                <?php echo $item->cari_durum ? 'Aktif' : 'Pasif'; ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url('cari/cari-karti-duzenle/' . $item->cari_id); ?>" class="btn btn-sm btn-primary">Düzenle</a>
                                                            <a href="<?php echo base_url('cari/cariHareketleri?cari=' . $item->cari_id); ?>" class="btn btn-sm btn-info">Hareketleri Gör</a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php echo $links; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('include/footer'); ?>
