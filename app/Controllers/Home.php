<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductModel;

class Home extends BaseController
{
	private $productModel=NULL;
	function __construct(){
		$this->productModel = new ProductModel();
	}
	public function index(){
		return view('index');
	}
	public function product(){
		return view('product');
	}
	public function saveProduct(){
		$data=[
			'product_name'=>$this->request->getPost('product_name'),
			'price'=>$this->request->getPost('price'),
			'quantity'=>$this->request->getPost('quantity'),
			'mfg_date'=>$this->request->getPost('mfg_date'),
			'exp_date'=>$this->request->getPost('exp_date')
		];
		$action_type=$this->request->getPost('action_type');
		if(empty($data['product_name'])){
			$result['status']=0;
			$result['message']="Product Name is Required, Please Enter Product Name";
			echo json_encode($result);die;
		}
		if(empty($data['price'])){
			$result['status']=0;
			$result['message']="Price is Required, Please Enter Price";
			echo json_encode($result);die;
		}
		if(empty($data['quantity'])){
			$result['status']=0;
			$result['message']="Quantity is Required, Please Enter Quantity";
			echo json_encode($result);die;
		}
		if(empty($data['mfg_date'])){
			$result['status']=0;
			$result['message']="Mfg. Date is Required, Please Enter Mfg. Date";
			echo json_encode($result);die;
		}
		if(empty($data['exp_date'])){
			$result['status']=0;
			$result['message']="Exp. Date is Required, Please Enter Exp. Date";
			echo json_encode($result);die;
		}
		$img='';
		$files=$this->request->getFile('image');
		if(!$files->isValid()){
			if($action_type=="Add"){
				//if image not uploaded and action type add
				$result['status']=0;
				$result['message']="Product Image is Required, Please Choose Product Image";
				echo json_encode($result);die;
			}else{
				//if image not uploaded and want to retain old image
				$img=$this->request->getPost('old_image');
			}
			
		}else{
			//image is valid 
			$file=$files->move('public/upload/product/', $files->getClientName());
			if($files->hasMoved()){
				//image successfully uploaded
				$img=$files->getName();
			}else{
				$result['status']=0;
				$result['message']="Failed to upload Product, Please try again....";
				echo json_encode($result);die;
			}
			if($action_type=="Edit"){
				//image uploaded and action type update product then delete old image
				if(file_exists("public/upload/product/".$this->request->getPost('old_image'))){
					unlink("public/upload/product/".$this->request->getPost('old_image'));
				}
			}
		}
		$data['image']=$img;
		if($action_type=="Add"){
			//Insert product record
			$res=$this->productModel->insert($data);
		}else{
			//update product record
			$data['updated_at']=date("Y-m-d")." ".date("H:i:s");
			$res = $this->productModel->update(['id'=>$this->request->getPost('productid')], $data);
		}
		
		if($res){
			$result['status']=1;
			$result['message']="Product saved Successful";
			echo json_encode($result);die;
		}else{
			$result['status']=0;
			$result['message']="Failed to save Product";
			echo json_encode($result);die;
		}
	}

	function getProductList(){
		$this->productModel->orderBy('id', "DESC");
		$product_list = $this->productModel->getWhere(['id>'=>0])->getResultArray();
		$output='';
		if(!empty($product_list)){
			$sr=1;
			foreach ($product_list as $key => $value) {
				
				$output.='<tr>
                    <td>'.$sr++.'</td>
                    <td>'.$value['product_name'].'</td>
                    <td>'.$value['price'].'</td>
                    <td>'.$value['quantity'].'</td>
                    <td>'.$value['mfg_date'].'</td>
                    <td>'.$value['exp_date'].'</td>
                    <td> <img src="'.base_url().'/public/upload/product/'.$value['image'].'" alt="Product Image" /></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-rounded btn-icon" onclick="editProduct(`'.$value['id'].'`)"> 
                        <i class="ti-pencil"></i> 
                      </button>
                      <button type="button" class="btn btn-danger btn-rounded btn-icon"  onclick="deleteProduct(`'.$value['id'].'`)"> 
                        <i class="ti-trash"></i> 
                      </button>
                    </td>
                </tr>';
            }
        }else{
        	$output='<tr>
                <td colspan="9" style="text-align:center">No Record Found....</td>
            </tr>';
        }
        echo $output;
		
	}

	function editProduct(){
		$productid = $this->request->getPost('id');
		$product_data = $this->productModel->getWhere(['id'=>$productid])->getRowArray();
		if($product_data){
			$result['status']=1;
			$result['message']=$product_data;
			echo json_encode($result);die;
		}else{
			$result['status']=0;
			$result['message']="Some thing went wrong....";
			echo json_encode($result);die;
		}
	}
	function deleteProduct(){
		$productid = $this->request->getPost('id');
		
		$product_data = $this->productModel->getWhere(['id'=>$productid])->getRowArray();
		$old_img=$product_data['image'];

		/*$result['status']=0;
		$result['message']=$product_data['image'];
		echo json_encode($result);die;*/

		$res = $this->productModel->delete($productid)->getRowArray();

		if(!$res){
			if(file_exists("public/upload/product/".$old_img)){
				unlink("public/upload/product/".$old_img);
			}
			$result['status']=1;
			$result['message']="Product Delete Successfully";
			echo json_encode($result);die;
		}else{
			$result['status']=0;
			$result['message']="Product not Deleted, Try again....";
			echo json_encode($result);die;
		}
	}
}
