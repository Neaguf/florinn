<?php

class oldGrupuri_utilizatori extends BP_Controller{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM rights_groups t1 WHERE 1=1  " );

            $sql->addIfNeeded( $filters['Nume'], '', " AND t1.Nume LIKE '%%%s%%' ");


            $sql->addLimitFromPagination($pg_info);


            $result = $sql->getResult();
            $rows   = $result->Rows;
            //
            $pg_info->RowCount = $result->FullRowsCount;
            //
            $ret->Results        = $rows;
            $ret->PaginationInfo = $pg_info;
        }

        echo  json_encode($ret);
    }


    public function get_info_for_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $ret->grupuri_utilizatori=$this->db->query('SELECT Nume FROM grupuri_utilizatori')->result();
        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");

            if ($id != -1) {
                $ret->Item           = new DbRightsGroups($id);
            }

            $drepturiBifate = array();

            if($id != -1)
            {
                $drepturiCategorieUtilizator = $this->db->get_where("rights_groups_link", array("IdGroup" => $id))->result();

                foreach($drepturiCategorieUtilizator as $dcu)
                {
                    $drepturiBifate[] = $dcu->IdRight;
                }
            }

            $categorii = DbRightsCategoryModel::query()->get();

            foreach($categorii as $categorie)
            {
                $categorie->Drepturi        = DbRightsModel::query()->where("CategoryId", $categorie->Id)->get();
                $countBifate                = 0;

                foreach($categorie->Drepturi as $drept)
                {
                    if ($id == -1) {
                        $drept->Bifat = false;
                    } else if ($id != -1) {
                        if (in_array($drept->Id, $drepturiBifate)) {
                            $drept->Bifat = true;
                            $countBifate++;
                        } else {
                            $drept->Bifat = false;
                        }
                    }
                }

                $categorie->Nedeterminat    = $countBifate > 0 && $countBifate < count($categorie->Drepturi);
                $categorie->CheckAll        = $countBifate == count($categorie->Drepturi);
            }

            $ret->Drepturi = $categorii;
        }

        echo json_encode($ret);
    }

    public function save()
    {
        $ret   = $this->verify_login();

        if( !$ret->NotLogged ) {
            $categorieUtilizator = $this->input->post("item");
            $categoriiDrepturi   = json_decode($this->input->post("drepturi"));

            $cat = new DbRightsGroupsModel();
            $cat->constructFromArray($categorieUtilizator);

            if ($cat->Id == -1)
                $cat->Insert();
            else
                $cat->Update();

            DbRightsGroupsLinkModel::query()->where("IdGroup", $cat->Id)->delete();
            foreach ($categoriiDrepturi as $cd)
            {
                if (!isset($cd->Drepturi)) {
                    continue;
                }
                foreach($cd->Drepturi as $drept)
                {
                    if($drept->Bifat == 'true')
                    {
                        $rg = new DbRightsGroupsLinkModel();

                        $rg->IdGroup = $cat->Id;
                        $rg->IdRight = $drept->Id;
                        $rg->Insert();
                    }
                }
            }
        }

        echo json_encode($ret);
    }

    public function delete(){
        $ret   = $this->verify_login();

        if( !$ret->NotLogged ) {
            $item = $this->input->post("item");
            $this->db->where('Id', $item['Id'])->delete('rights_groups');
        }
    }

}