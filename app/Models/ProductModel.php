<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model{
	
	protected $table = "product";
	protected $primaryKey = 'id';
	protected $DBGroup = 'default';
	protected $allowedFields = ['product_name', 'price', 'quantity', 'mfg_date', 'exp_date', 'image'];
	protected $validationRules = [
		'product_name'=> 'required|alpha_space',
		'price'=>'required|numeric',
		'quantity'=>'required|numeric',
		'mfg_date'=>'required',
		'exp_date'=>'required',
		'image'=>'required'
	];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
}