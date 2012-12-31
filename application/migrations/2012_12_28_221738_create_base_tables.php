<?php

class Create_Base_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{

/*		Schema::create('tests', function($table)
		{
			$table->increments('id');
			$table->integer('tst')->unsigned();
			$table->timestamps();
			$table->index('tst', 'tst_ix');
		});
		dd();*/

//	CREATE TABLES WITH INCOMING KEYS

/*********************/
/* LOCATIONS         */
/*********************/
/*	CREATE TABLE `locations` (
	`idLocation` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`code` VARCHAR(2) NOT NULL,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	`level` TINYINT UNSIGNED NOT NULL,
	`parent` INT UNSIGNED NOT NULL
	)
*/
		Schema::create('locations', function($table)
		{
			$table->increments('idLocation');
			$table->string('code', 2);
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->integer('level')->unsigned();
			$table->integer('parent')->unsigned();
			$table->timestamps();
		});

/*********************/
/* CHAINS            */
/*********************/
/*	CREATE TABLE `chains` (
	`idChain` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	`enWebsite` VARCHAR(100),
	`frWebsite` VARCHAR(100),
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	) 
*/
		Schema::create('chains', function($table)
		{
			$table->increments('idChain');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->string('enWebsite', 100)->nullable();
			$table->string('frWebsite', 100)->nullable();
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

/*********************/
/* EXTRAS            */
/*********************/
/*	CREATE TABLE `extras` (
	`idExtra` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	)
*/
		Schema::create('extras', function($table)
		{
			$table->increments('idExtra');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

/*********************/
/* STATES            */
/*********************/
/*	CREATE TABLE `states` (
	`idState` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	`level` TINYINT UNSIGNED NOT NULL,
	`parent` INT UNSIGNED NOT NULL
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	)
*/
		Schema::create('states', function($table)
		{
			$table->increments('idState');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->integer('level')->unsigned();
			$table->integer('parent')->unsigned();
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

/*********************/
/* SHAPES            */
/*********************/
/*	CREATE TABLE `shapes` (
	`idShape` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	)
*/
		Schema::create('shapes', function($table)
		{
			$table->increments('idShape');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

/*********************/
/* CATEGORIES        */
/*********************/
/*	CREATE TABLE `categories` (
	`idCategory` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	)
*/
		Schema::create('categories', function($table)
		{
			$table->increments('idCategory');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

/*********************/
/* BRANDS            */
/*********************/
/*	CREATE TABLE `brands` (
	`idChain` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`enName` VARCHAR(25) NOT NULL,
	`frName` VARCHAR(25) NOT NULL,
	`enWebsite` VARCHAR(100),
	`frWebsite` VARCHAR(100),
	`house` BIT DEFAULT 0,
	`upc` INTEGER UNSIGNED,
	KEY `enName_ix` (`enName`),
	KEY `frName_ix` (`frName`)
	) 
*/
		Schema::create('brands', function($table)
		{
			$table->increments('idBrand');
			$table->string('enName', 25);
			$table->string('frName', 25);
			$table->string('enWebsite', 100)->nullable();
			$table->string('frWebsite', 100)->nullable();
			$table->boolean('house')->default(0);
			$table->integer('upc')->unsigned()->nullable();
			$table->timestamps();
			$table->index('enName', 'enName_ix');
			$table->index('frName', 'frName_ix');
		});

//	CREATE TABLES WITH INCOMING AND OUTGOING KEYS (TO TABLES ABOVE)

/*********************/
/* FLYERS            */
/*********************/
/*	CREATE TABLE `flyers` (
	`idFlyer` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`idChain` INT UNSIGNED NOT NULL,
	`idLocation` INTEGER UNSIGNED NOT NULL,
	`dateStart` DATE NOT NULL,
	`dateEnd` DATE NOT NULL,
	`frInfo` TEXT,
	`enInfo` TEXT,
	KEY `idChain_ix` (`idChain`),
	KEY `idLocation_ix` (`idLocation`),
	CONSTRAINT `fly_cha_fk` FOREIGN KEY (`idChain`) REFERENCES `chains` (`idChain`),
	CONSTRAINT `fly_loc_fk` FOREIGN KEY (`idLocation`) REFERENCES `locations` (`idLocation`)
	)
*/
		Schema::create('flyers', function($table)
		{
			$table->increments('idFlyer');
			$table->integer('idChain')->unsigned();
			$table->integer('idLocation')->unsigned();
			$table->date('dateStart');
			$table->date('dateEnd');
			$table->text('enInfo')->nullable();
			$table->text('frInfo')->nullable();
			$table->timestamps();
			$table->index('idChain', 'idChain_ix');
			$table->index('idLocation', 'idLocation_ix');
			$table->foreign('idChain', 'fly_cha_fk')->references('idChain')->on('chains');
			$table->foreign('idLocation', 'fly_loc_fk')->references('idLocation')->on('locations');
		});

/*********************/
/* PRODUCTS          */
/*********************/
/*	CREATE TABLE `products` (
	`idProduct` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`idBrand` INT UNSIGNED,
	`idCategory` INT UNSIGNED NOT NULL,
	`idShape` INT UNSIGNED,
	`idState` INT UNSIGNED NOT NULL,
	`idLocation` INT UNSIGNED,
	KEY `idBrand_ix` (`idBrand`),
	KEY `idCategory_ix` (`idCategory`),
	KEY `idShape_ix` (`idShape`),
	KEY `idState_ix` (`idState`),
	KEY `idLocation_ix` (`idLocation`),
	KEY `brn_prd_ix` (`idBrand`, `idProduct`),
	KEY `ctg_prd_ix` (`idCategory`, `idProduct`),
	KEY `lct_prd_ix` (`idLocation`, `idProduct`),
	CONSTRAINT `pro_bra_fk` FOREIGN KEY (`idBrand`) REFERENCES `brands` (`idBrand`),
	CONSTRAINT `pro_cat_fk` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
	CONSTRAINT `pro_sha_fk` FOREIGN KEY (`idShape`) REFERENCES `shapes` (`idShape`),
	CONSTRAINT `pro_sta_fk` FOREIGN KEY (`idState`) REFERENCES `states` (`idState`),
	CONSTRAINT `pro_loc_fk` FOREIGN KEY (`idLocation`) REFERENCES `locations` (`idLocation`)
)
*/
		Schema::create('products', function($table)
		{
			$table->increments('idProduct');
			$table->integer('idBrand')->unsigned()->nullable();
			$table->integer('idCategory')->unsigned();
			$table->integer('idShape')->unsigned()->nullable();
			$table->integer('idState')->unsigned();	
			$table->integer('idLocation')->unsigned()->nullable();
			$table->timestamps();
			$table->index('idBrand', 'idBrand_ix');
			$table->index('idCategory', 'idCategory_ix');
			$table->index('idShape', 'idShape_ix');
			$table->index('idState', 'idState_ix');
			$table->index('idLocation', 'idLocation_ix');
			$table->index(array('idBrand', 'idProduct'), 'brn_prd_ix');
			$table->index(array('idCategory', 'idProduct'), 'ctg_prd_ix');
			$table->index(array('idLocation', 'idProduct'), 'lct_prd_ix');
			$table->foreign('idBrand', 'pro_bra_fk')->references('idBrand')->on('brands');
			$table->foreign('idCategory', 'pro_cat_fk')->references('idCategory')->on('categories');
			$table->foreign('idShape', 'pro_sha_fk')->references('idShape')->on('shapes');
			$table->foreign('idState', 'pro_sta_fk')->references('idState')->on('states');
			$table->foreign('idLocation', 'pro_loc_fk')->references('idLocation')->on('locations');
		});

//	CREATE TABLES WITH ONLY OUTGOING KEYS

/*********************/
/* PRODUCT_EXTRA   */
/*********************/
/*	CREATE TABLE `product_extra` (
	`idProduct` INT UNSIGNED NOT NULL,
	`idExtra` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`idProd`, `idExtra`),
	KEY `idProduct_ix` (`idProduct`),
	KEY `idExtra_ix` (`idExtra`),
	CONSTRAINT `pe_pro_fk` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`),
	CONSTRAINT `pe_ext_fk` FOREIGN KEY (`idExtra`) REFERENCES `extras` (`idExtra`)
	)
*/
		Schema::create('product_extra', function($table)
		{
			$table->integer('idProduct')->unsigned();
			$table->integer('idExtra')->unsigned();
			$table->timestamps();
			$table->primary(array('idProduct', 'idExtra'));
			$table->index('idProduct', 'idProduct_ix');
			$table->index('idExtra', 'idExtra_ix');
			$table->foreign('idProduct', 'pe_pro_fk')->references('idProduct')->on('products');
			$table->foreign('idExtra', 'pe_ext_fk')->references('idExtra')->on('extras');
		});

/*********************/
/* DEALS             */
/*********************/
/*	CREATE TABLE `deals` (
	`idDeal` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`idFlyer` INT UNSIGNED NOT NULL,
	`idProduct` INT UNSIGNED NOT NULL,
	`price` DECIMAL(5,2) UNSIGNED,
	`enDisplay` VARCHAR(100),
	`frDisplay` VARCHAR(100),
	`minUnits` TINYINT UNSIGNED,
	`maxUnits` TINYINT UNSIGNED,
	`minWeight` SMALLINT UNSIGNED,
	`maxWeight` SMALLINT UNSIGNED,
	`minVolume` SMALLINT UNSIGNED,
	`maxVolume` SMALLINT UNSIGNED,
	`points` TINYINT UNSIGNED,
	`notes` TINYTEXT,
	KEY `idFlyer_ix` (`idFlyer`),
	KEY `idProduct_ix` (`idProduct`),
	KEY `fly_pro_ix` (`idFlyer`, `idProduct`),
	CONSTRAINT `dea_fly_fk` FOREIGN KEY (`idFlyer`) REFERENCES `flyers` (`idFlyer`),
	CONSTRAINT `dea_pro_fk` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`)
	)
*/
		Schema::create('deals', function($table)
		{
			$table->increments('idDeal');
			$table->integer('idFlyer')->unsigned();
			$table->integer('idProduct')->unsigned();
			$table->decimal('price', 5, 2)->unsigned();
			$table->string('enDisplay', 100)->nullable();
			$table->string('frDisplay', 100)->nullable();
			$table->integer('minUnits')->unsigned()->nullable();
			$table->integer('maxUnits')->unsigned()->nullable();
			$table->integer('minWeight')->unsigned()->nullable();
			$table->integer('maxWeight')->unsigned()->nullable();
			$table->integer('minVolume')->unsigned()->nullable();
			$table->integer('maxVolume')->unsigned()->nullable();
			$table->integer('points')->unsigned()->nullable();
			$table->text('notes')->nullable();
			$table->timestamps();
			$table->index('idFlyer', 'idFlyer_ix');
			$table->index('idProduct', 'idProduct_ix');
			$table->index(array('idFlyer', 'idProduct'), 'fly_pro_ix');
			$table->foreign('idFlyer', 'dea_fly_fk')->references('idFlyer')->on('flyers');
			$table->foreign('idProduct', 'dea_pro_fk')->references('idProduct')->on('products');
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::drop('tests');

//	DROP CHILD ONLY TABLES

		Schema::drop('deals');
		Schema::drop('product_extra');

//	DROP PARENT-CHILD TABLES

		Schema::drop('flyers');
		Schema::drop('products');

//	DROP PARENT TABLES

		Schema::drop('locations');
		Schema::drop('chains');
		Schema::drop('extras');
		Schema::drop('states');
		Schema::drop('shapes');
		Schema::drop('categories');
		Schema::drop('brands');
	}

}