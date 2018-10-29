<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $javasc;
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Rekening</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel_ajax">
                            <thead>
                                <tr>
                                    <th width="10%">Kode</th>
                                    <th>Nama Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var url = '<?php echo site_url('frontend/rekening/Belanja/ajax_list') ?>';
    datatable(url);
</script>