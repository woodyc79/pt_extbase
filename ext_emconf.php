<?php

########################################################################
# Extension Manager/Repository config file for ext "pt_extbase".
#
# Auto generated 25-07-2011 05:57
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Tools for Extbase development',
	'description' => 'Collection of tools for Extbase Extension development.',
	'category' => 'plugin',
	'author' => 'Michael Knoll,Daniel Lienert',
	'author_email' => 'knoll@punkt.de,lienert@punkt.de',
	'author_company' => 'punkt.de GmbH,punkt.de GmbH',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.2',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '1.3.0',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:67:{s:16:"ext_autoload.php";s:4:"a18d";s:12:"ext_icon.gif";s:4:"5837";s:17:"ext_localconf.php";s:4:"a2d4";s:14:"ext_tables.php";s:4:"a423";s:14:"ext_tables.sql";s:4:"04b0";s:16:"kickstarter.json";s:4:"0bfa";s:19:"Classes/Context.php";s:4:"2dc0";s:28:"Classes/ContextInterface.php";s:4:"859b";s:15:"Classes/Div.php";s:4:"4f9c";s:29:"Classes/Assertions/Assert.php";s:4:"3f14";s:33:"Classes/Collection/Collection.php";s:4:"c671";s:39:"Classes/Collection/ObjectCollection.php";s:4:"a5b3";s:47:"Classes/Configuration/AbstractConfiguration.php";s:4:"d573";s:54:"Classes/Configuration/AbstractConfigurationBuilder.php";s:4:"f53c";s:47:"Classes/Controller/AbstractActionController.php";s:4:"a6af";s:31:"Classes/Exception/Assertion.php";s:4:"79bd";s:31:"Classes/Exception/Exception.php";s:4:"bdd1";s:30:"Classes/Exception/Internal.php";s:4:"0fb9";s:42:"Classes/Extbase/AbstractExtbaseContext.php";s:4:"0027";s:36:"Classes/Lifecycle/EventInterface.php";s:4:"e555";s:33:"Classes/Lifecycle/HookManager.php";s:4:"5262";s:29:"Classes/Lifecycle/Manager.php";s:4:"ea66";s:36:"Classes/Lifecycle/ManagerFactory.php";s:4:"fb8a";s:29:"Classes/Registry/Registry.php";s:4:"ebba";s:39:"Classes/State/IdentifiableInterface.php";s:4:"989c";s:38:"Classes/State/GpVars/GpVarsAdapter.php";s:4:"e256";s:45:"Classes/State/GpVars/GpVarsAdapterFactory.php";s:4:"e5bd";s:50:"Classes/State/GpVars/GpVarsInjectableInterface.php";s:4:"58a4";s:53:"Classes/State/Session/SessionPersistableInterface.php";s:4:"5946";s:51:"Classes/State/Session/SessionPersistenceManager.php";s:4:"d19b";s:58:"Classes/State/Session/SessionPersistenceManagerFactory.php";s:4:"75c5";s:50:"Classes/State/Session/Storage/AdapterInterface.php";s:4:"72b3";s:43:"Classes/State/Session/Storage/DBAdapter.php";s:4:"30e2";s:50:"Classes/State/Session/Storage/DBAdapterFactory.php";s:4:"421a";s:54:"Classes/State/Session/Storage/FeUserSessionAdapter.php";s:4:"f894";s:52:"Classes/State/Session/Storage/NullStorageAdapter.php";s:4:"e9c4";s:48:"Classes/State/Session/Storage/SessionAdapter.php";s:4:"f051";s:25:"Classes/Utility/Debug.php";s:4:"1a45";s:29:"Classes/Utility/NameSpace.php";s:4:"68c0";s:25:"Classes/View/BaseView.php";s:4:"7c1c";s:38:"Configuration/TypoScript/constants.txt";s:4:"1d06";s:34:"Configuration/TypoScript/setup.txt";s:4:"98ec";s:24:"Documentation/Readme.txt";s:4:"7540";s:40:"Resources/Private/Language/locallang.xml";s:4:"d8d9";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"600d";s:44:"Resources/Private/Templates/Debug/Debug.html";s:4:"e259";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:26:"Tests/AbstractBaseTest.php";s:4:"68ce";s:41:"Tests/Collection/ObjectCollectionTest.php";s:4:"38e5";s:56:"Tests/Configuration/AbstractConfigurationBuilderTest.php";s:4:"b5ff";s:49:"Tests/Configuration/AbstractConfigurationTest.php";s:4:"6593";s:49:"Tests/Controller/AbstractActionControllerTest.php";s:4:"fbcf";s:35:"Tests/Lifecycle/HookManagerTest.php";s:4:"05b3";s:38:"Tests/Lifecycle/ManagerFactoryTest.php";s:4:"e437";s:31:"Tests/Lifecycle/ManagerTest.php";s:4:"5fd0";s:40:"Tests/State/GpVars/GpVarsAdapterTest.php";s:4:"58e4";s:60:"Tests/State/Session/SessionPersistenceManagerFactoryTest.php";s:4:"83a2";s:53:"Tests/State/Session/SessionPersistenceManagerTest.php";s:4:"74d3";s:52:"Tests/State/Session/Storage/DBAdapterFactoryTest.php";s:4:"3b85";s:45:"Tests/State/Session/Storage/DBAdapterTest.php";s:4:"eaac";s:56:"Tests/State/Session/Storage/FeUserSessionAdapterTest.php";s:4:"7e5b";s:50:"Tests/State/Session/Storage/SessionAdapterTest.php";s:4:"ad5f";s:38:"Tests/State/Stubs/GetPostVarObject.php";s:4:"0f0c";s:39:"Tests/State/Stubs/PersistableObject.php";s:4:"16e4";s:40:"Tests/State/Stubs/SessionAdapterMock.php";s:4:"4441";s:27:"Tests/Utility/DebugTest.php";s:4:"4a14";s:36:"Tests/Utility/NameSpaceArrayTest.php";s:4:"8c17";}',
);

?>