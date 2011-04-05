<?php

//use \Application\Data\Repository as Repository;

class LeadRepositoryTest extends PHPUnit_Framework_TestCase
{
	private $_leadRepository = null;
	
	function setUp()
	{
		$this->_leadRepository = new TestUserRepository();
	}
	
	public function LeadRepository_Contains_Leads()
	{
  	$rep = new TestCatalogRepository();
    Assert.IsNotNull(rep.GetCategories());
  }
	      
  public function Lead_ShouldHave_Name_Description__Price_Discount_WeightInPounds_Fields() 
  {
  	//$p = new Product("TestName", "TestDescription", 100, 20,5);
    //Assert.AreEqual("TestName", p.Name);
    //Assert.AreEqual("TestDescription", p.Description);
    //Assert.AreEqual(20, p.DiscountPercent);
    //Assert.AreEqual(100, p.Price);
    //Assert.AreEqual(5, p.WeightInPounds);
	}

  public function LeadRepository_Returns_One_Lead_When_Filtered_ByID_1() 
  {
  	$rep = new TestCatalogRepository();
		$products = rep.GetProducts()
                .WithProductID(1)
                .ToList();

  	Assert.AreEqual(1, products.Count);
 	}

  public function LeadRepository_Returns_Two_Lead_When_Filtered_By_CreatorName_Admin()
  {
  	$p = _catalogService.GetProduct(1);
    Assert.IsNotNull(p);
  }

  public function Catalog_Repository_Should_Insert_New_Product_On_Save() 
  {
  	$p = new Product("TestName", "TestDescription", 100, 20, 5);
    $productCount = _catalogRepository.GetProducts().Count();
    _catalogRepository.SaveProduct(p);
    $productCount2 = _catalogRepository.GetProducts().Count();
    Assert.IsTrue(productCount2 == productCount + 1);
 	}
  
  public function Catalog_Repository_Should_Update_Existing_Product_On_Save() 
  {
  	$p = _catalogService.GetProduct(1);
    Assert.AreEqual(InventoryStatus.InStock, p.Inventory);
		$p->Inventory = InventoryStatus.BackOrder;
    _catalogRepository.SaveProduct(p);
		$p = _catalogService.GetProduct(1);
    Assert.AreEqual(InventoryStatus.BackOrder, p.Inventory);
	}
}