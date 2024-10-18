<?php

namespace App\Controllers;
use App\Models\RiderModel;
use App\Models\UserModel;
require_once FCPATH . 'assets/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use DateTime;

class Home extends BaseController
{
    var $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index(): string
    {
        $riderModel = new RiderModel();
        $data['riders'] = $riderModel->paginate(24);
        $data['pager'] = $riderModel->pager;
        return view('main', $data);
    }

    public function rider($url)
    {
        $riderModel = new RiderModel();
        $data['rider'] = $riderModel->where('link', 'rider/'.$url)->first();
        return view('rider', $data);
    }

    public function pdf()
    {
        return view('pdf');
    }

    public function pdf_for_rider($id)
    {
        $riderModel = new RiderModel();
        $rider = $riderModel->find($id);
        $content = '';
        $content .= '<h1>'.$rider->first_name.' '.$rider->last_name.'</h1>';
        if (isset($rider->photo)) {
            $content .= '<img class="img img-fluid my-1" src="'.base_url('assets/img/riders/'.$rider->photo).'" alt="'.$rider->first_name.' '.$rider->last_name.'">';
        } 
        $content .= '
        <div><br></br><b>Details:</b><br></br><table border="1"><tr><td>Country: </td><td>'.$rider->country.'</td></tr><tr><td>Weight: </td><td>';
        if($rider->weight != 0 && $rider->weight != null) $content .= $rider->weight.' kg'; else $content .= 'Unknown';
        $content.='</td></tr><tr><td>Height: </td><td>';
        if($rider->height != 0 && $rider->height != null) $content .= $rider->height.' cm'; else $content .= 'Unknown';
        $content.='</td></tr><tr><td>Date of birth: </td><td>';
        $date = new DateTime($rider->date_of_birth); $content .= $date->format('F j, Y');
        $content.='</td></tr><tr><td>Place of birth: </td><td>';
        if($rider->place_of_birth != 0 && $rider->place_of_birth != null) $content .= $rider->place_of_birth; else $content .= 'Unknown';
        $content.='</td></tr></table>
        </div>';
        $this->generate_pdf($content);
    }

    public function generate_pdf($data = ""){
        if($data == "") {
            $data = $this->request->getVar('content');
        }
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $html = '
        <!DOCTYPE html>
        <html lang="cs">
        <head>
            <meta charset="UTF-8">
            <title>Generated PDF</title>
            <style>
                    body { font-family: DejaVu Sans; font-size: 12px; }
            </style>
        </head>
        <body>
            '.$data.'
        </body>
        </html>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        echo $html;
        //return;
        return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($dompdf->output())->send();
    }

    public function show_add()
    {
        return view('add_form');
    }

    public function add()
    {
        $data['first_name'] = $this->request->getVar('first_name');
        $data['last_name'] = $this->request->getVar('last_name');
        $data['country'] = $this->request->getVar('country');
        $data['date_of_birth'] = $this->request->getVar('date_of_birth');
        $data['weight'] = $this->request->getVar('weight');
        $data['height'] = $this->request->getVar('height');
        $data['place_link'] = '';
        $data['link'] = 'rider/'.strtolower($data['first_name']).'-'.strtolower($data['last_name']);
        $riderModel = new RiderModel();
        $riderModel->insert((object) $data);
        return redirect()->to($data['link']);
    }

    public function remove($id)
    {
        $riderModel = new RiderModel();
        $riderModel->delete($id);
        return redirect()->to('/');
    }

    public function show_edit($id)
    {
        $riderModel = new RiderModel();
        $data['rider'] =  $riderModel->find($id);
        return view('edit_form', $data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['first_name'] = $this->request->getVar('first_name');
        $data['last_name'] = $this->request->getVar('last_name');
        $data['country'] = $this->request->getVar('country');
        $data['date_of_birth'] = $this->request->getVar('date_of_birth');
        $data['weight'] = $this->request->getVar('weight');
        $data['height'] = $this->request->getVar('height');
        $riderModel = new RiderModel();
        $riderModel->save((object) $data);
        $link = $riderModel->find($id)->link;
        return redirect()->to($link);
    }

    public function graph()
    {
        return view('graph');
    }

    public function login()
    {
        $data['message'] = $this->session->getFlashdata('login_message');
        return view('login', $data);
    }

    public function check_login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();

        $user = $userModel->where('username', $username)->first();

        if (empty($user))
        {
            $this->session->setFlashdata('login_message', 'Wrong Username or Password!');
            return redirect()->to('login');
        }

        if (!password_verify($password, $user->password))
        {
            $this->session->setFlashdata('login_message', 'Wrong Username or Password!');
            return redirect()->to('login');
        }

        $this->session->set('username', $username);
        $this->session->set('password', password_hash($password, PASSWORD_DEFAULT));
        return redirect()->to('/');
    }
}
