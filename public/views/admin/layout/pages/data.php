<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php echo $this->session->flashdata('notif'); ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-exapnd2"></i> Pages</h4>
                </div>
                <div class="content">
                    <div class="search">
                        <form method="GET" action="<?php echo base_url('auth/pages/search/');?>">
                            <div class = "input-group">
                                <input type = "text" name = "q" class = "typeahead tt-query" placeholder="Masukkan kata kunci dan enter" autocomplete="off" id="pages">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <span class = "input-group-btn">
                              <button class = "btn btn-default" type = "submit">
                                 <i class="fa fa-search"></i> Search
                              </button>
                           </span>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped" style="margin-top:20px;font-family: Roboto;font-weight: 300;">
                        <tbody>
                        <thead>
                        <tr>
                            <th class="text-center" style="color: #000;">No.</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-file-o"></i> JUDUL PAGES</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-user-circle"></i> AUTHOR</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-calendar-o"></i> DATE MODIFIED</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-cogs"></i> OPTIONS</th>
                        </tr>
                        </thead>
                        <?php
                        if($pages != NULL):
                        $no = $this->uri->segment('4') + 1;
                        foreach($pages->result() as $hasil):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $hasil->judul_page ?></td>
                                <td><?php echo $hasil->nama_user ?></td>
                                <td><?php echo $hasil->date_modified ?></td>
                               <td class="text-center">
                                    <a class='badge badge-success' style="font-family: Roboto;font-weight: 400;background-color: #358420;" data-toggle="tooltip" data-placement="top" title="Edit" href='<?php echo base_url() ?>auth/pages/edit/<?php echo $this->encryption->encode($hasil->id_page) ?>'><i class="fa fa-pencil"></i> Edit</a>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <?php echo $paging ?>
                    <?php else : ?>
                        </tbody>
                        </table>
                        <div class="alert alert-danger">
                            <span><b> Warning! </b> Data tidak ada didatabase </span>
                        </div>
                        <div class="reload" style="text-align: center;margin-bottom: 7px">
                            <a  href="<?php echo base_url('auth/pages?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>