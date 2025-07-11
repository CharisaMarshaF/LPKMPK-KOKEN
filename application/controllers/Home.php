<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Konten_model');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('language');
    }
    public function index() {
        $this->load->model('About_model');
        $this->load->model('Konten_model');
        $about = $this->About_model->get_about();        
        $features = $this->About_model->get_features();   
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $this->db->from('tiktok_videos');
        $tiktok = $this->db->get()->result_array();

        $this->db->from('galeri');
        $galeri = $this->db->get()->result_array();

        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();

        $this->db->from('testimoni');
        $this->db->where('status', 'publish');
        $testimoni = $this->db->get()->result_array();

        $konten = $this->Konten_model->get_konten_with_fotos(6);
        $recentpost = $this->Konten_model->recentpost();

        $data = array(
            'judul'             => "Beranda | Binco Ran Nusantara",
            'konfig'            => $konfig,
            'konten'            => $konten,
            'tiktok_videos'     => $tiktok,
            'galeri'            => $galeri,
            'caraousel'         => $caraousel,
            'testimoni'         => $testimoni,
            'about'             => $about,
            'features'          => $features,
            
        );

        $this->load->view('beranda', $data);
    }


    public function set_language($language = 'indonesian') {
        $this->session->set_userdata('language', $language);
        redirect('home');
    }
     public function blog() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->load->library('pagination');
        $this->load->helper('text');

        $search = $this->input->get('search', true); // name="search" di form pencarian

        // Setup konfigurasi pagination
        $config['base_url'] = base_url('home/blog');
        $config['total_rows'] = $this->get_total_konten($search);
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['reuse_query_string'] = TRUE;

        // Styling pagination Bootstrap
        $config['full_tag_open'] = '<ul class="pagination pagination-primary-soft d-inline-block d-md-flex rounded mb-0">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li class="page-item mb-0">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li class="page-item mb-0">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_open'] = '<li class="page-item mb-0">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_open'] = '<li class="page-item mb-0">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active mb-0"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item mb-0">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        // Hitung offset
        // Pastikan $this->uri->segment(3) selalu string, bahkan jika kosong/null
        $page_segment = (string) $this->uri->segment(3);
        $page_number = ctype_digit($page_segment) ? (int)$page_segment : 1;
        $page = ($page_number - 1) * $config['per_page'];

        // Ambil data konten berdasarkan page & search
        $konten_data = $this->get_filtered_konten($search, $config['per_page'], $page);
        $konten = [];

        foreach ($konten_data as $item) {
            $item['fotos'] = $this->Konten_model->get_konten_fotos($item['id_konten']);
            $konten[] = $item;
        }

        $pagination_links = $this->pagination->create_links();

        // Jika AJAX request
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'konten' => $konten,
                'pagination' => $pagination_links
            ]);
            return;
        }

        $konfig = $this->db->get('konfigurasi')->row();
        $galeri = $this->db->get('galeri')->result_array();
        $caraousel = $this->db->get('caraousel')->result_array();

        $data = array(
            'judul' => "Beranda | Binco Ran Nusantara",
            'konfig' => $konfig,
            'galeri' => $galeri,
            'caraousel' => $caraousel,
            'konten' => $konten,
            'recentpost' => [],
            'recentfooter' => [],
            'pagination' => $pagination_links
        );

        $this->load->view('blog', $data);
    }



    public function get_filtered_konten($keyword = null, $limit = 8, $offset = 0) {
        $this->db->from('konten a');
        $this->db->join('user c', 'a.username = c.username', 'left');
        if (!empty($keyword)) {
            $this->db->like('a.judul', $keyword);
            $this->db->or_like('a.keterangan', $keyword);
        }
        $this->db->order_by('a.id_konten', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function get_total_konten($keyword = null) {
        if (!empty($keyword)) {
            $this->db->like('judul', $keyword);
            $this->db->or_like('keterangan', $keyword);
        }
        return $this->db->count_all_results('konten');
    }

    
    public function galeri(){
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        
        $this->db->from('konten');
        $konten = $this->db->get()->result_array();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $this->db->from('galeri');
        $galeri = $this->db->get()->result_array(); 
        $data = array(
            'judul'        => "Galeri Foto | Binco Ran Nusantara",
            'konfig'       => $konfig,
            'konten'       => $konten,
            'galeri'       => $galeri,
            'caraousel'       => $caraousel,
        );
         $this->load->view('galeri', $data);
    }
    public function detail($slug = null) {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        if (!$slug) {
            show_404();
        }

        $this->db->from('konten');
        $this->db->where('slug', $slug);
        $konten = $this->db->get()->row_array();

        if (!$konten) {
            show_404();
        }

        // ✅ Ambil semua foto terkait konten
        $fotos = $this->Konten_model->get_konten_fotos($konten['id_konten']);

        $konfig = $this->db->get('konfigurasi')->row();
        $recentpost = $this->Konten_model->recentpost();
        $galeri = $this->db->get('galeri')->result_array();
        $caraousel = $this->db->get('caraousel')->result_array();

        $data = array(
            'judul' => $konten['judul'] . " | Binco Ran Nusantara",
            'konten' => $konten,
            'fotos' => $fotos, // ✅ kirim ke view
            'konfig' => $konfig,
            'recentpost' => $recentpost,
            'galeri' => $galeri,
            'caraousel' => $caraousel,
        );

        $this->load->view('detail', $data);
    }
    
    public function about() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);

        $this->load->model('About_founder_model');
        $about_founder = $this->About_founder_model->get_about();        
        $features_founder = $this->About_founder_model->get_features();  
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
             'about_founder'     => $about_founder,
            'features_founder'  => $features_founder,
        );
        $this->load->view('about', $data);
    }

    public function contact() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
        );
        $this->load->view('contact', $data);
    }
    
    public function faq() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
        );
        $this->load->view('faq', $data);
    }
    
    
}
