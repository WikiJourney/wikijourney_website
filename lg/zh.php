<?php
//========================================================//
//============> LANGAGE FILE : CHINESE <==================//
//========================================================//


//===================> Global Content <===================//

//===> General

define("_TITLE",			"WikiJourney - Rediscover Tourism.");
define("_CATCHPHRASE",		"Visit a city with Wikipedia!");
define("_SRC_IMAGE_LOGO",	"./images/design/logo_and_catchphrase/fr.png");
//===> Top
define("_INDEX",			"首页");
define("_TEAM",				"您的路线");
define("_ABOUT",			"关于我们");
define("_BLOG",				"博客");

//===> Bottom
define("_OUR_PARTNERS",		"合作伙伴");
define("_FOLLOW_US",		"关注我们 !");

//========================> Pages <========================//

//===> index.php
define("_WELCOME_TITLE",	"欢迎访问 !");
define("_WELCOME_MESSAGE",	"欢迎来到WikiJourney! 我们根据您选择的地点在周围显示地图并向您提供维基百科的信息 <br> 请填写信息开始探索吧！ <br> <br>");
define("_BUTTON_POI_AROUND","在我周围寻找有意思的地点!");
define("_ADRESS_LOOK_UP",	"在一个特定地点周围寻找!");
define("_ADRESS_FAILURE",	"此地址不存在 !");
define("_GEOLOC_FAILURE",	"Sorry but we can't find your position.");
define("_AROUND_LOCATION", 	"在一个特定地点周围寻找!");
define("_AROUND_ME",		"在附近寻找有意思的地点!");
define("_NOTE_GEOLOC",		"<strong>Geolocation failed</strong><br/>
							Depending on the device you are using and the way you are connected to the Internet, we are not always able to retrieve your location. You also have to allow WikiJourney to access your location.");
define("_NOTE_MAXPOI",      "Note: due to restrictions from Wikipedia, you will not be able to load all information (e.g. image or description) when looking for more than 50 POI.");
define("_OPTIONS",			"选项 :");
define("_RANGE",			"范围 (km) : ");
define("_MAX_POI",			"最大值 :");
define("_PLACEHOLDER",		"在此输入地点名称.");
define("_LOADING",			"Loading...");
define("_RETRY",            "Retry !");
define("_PATH_CREATED",		"Your path has been created!");

//===> team.php
define("_TEAM_TITLE",		"团队");
define("_TEAM_WHO_R_WE",	"成员简介");
define("_TEAM_QUICKDESC",
	                        "我们是法国里尔中央理工学院一个七个学生组成的项目开发团队，学校在法国北方省首府里尔市。在我们前两年的学习中，我们需要组成一个团队共同开发一个实际项目。我们会做到最好来实现这个项目");

define("_S_ARNOUTS_POSTE", 	"项目主管<br/>Web开发") ;
define("_P_ARZELIER_POSTE", "服务器开发<br/>Web开发");
define("_T_GAUDIN_POSTE", 	"Java开发<br/>服务器开发");
define("_N_HATIM_POSTE", 	"财务 - 合作伙伴<br/>Java开发");
define("_B_HUBER_POSTE", 	"合作伙伴<br/>Web开发");
define("_J_MAES_POSTE", 	"秘书<br/>Web开发");
define("_Y_WANG_POSTE", 	"Java开发<br/><br/>");

//===> about.php
define("_ABOUT_TITLE", 		"Wikijourney 项目简介");
define("_ABOUT_TEXT","
							<p>Wikijourney是一个学生开发项目，通过获取用户在城市中的位置，可以将用户所处地点和维基百科的相关内容相联系。
							<br> 具体来说，我们希望开发一个App，根据您的偏好，找到景点并为您规划最佳旅行路线。
							</p>

							<h2>为什么选择开发App? </h2>
							<p>
							智能手机的普及以及便携性，并且3G网络使得用户可以更加便捷地获取网上的信息，
							<br>我们建议您可以通过离线功能提前下载地图及相关信息，在旅行过程中节省流量费用。
							</p>

							<h2>WanderWiki 回归啦 ! </h2>
							<p>
							如果您已经用过了<a href=\"http://wiki-geolocalisation.wix.com/wanderwiki\">WanderWiki</a>，您就不会对我们的项目感到困惑。Wikijourney是WanderWiki的继承，提供全新的地图和更多更强大的功能。
							</p>

							<h2>问题和建议 </h2>
							<p>我们期待您的建议和意见! 通过Git参与我们的项目, 或者通过电子邮件 <a href=\"mailto:wikijourneydev@gmail.com\">联系我们</a>!</p>");


//===> technical.php
define("_TECHNICAL_TITLE",	"技术支持");
define("_TECHNICAL_TEXT",	"此网页还在建设当中，敬请期待! ;)");


//===> map.php
define("_MAP_POI_LINK",				"维基百科");
define("_MAP_CART_LINK",			"添加您的路径!");
define("_MAP_POI_TYPE_FILE",		"lg/zh.txt");
define("_LOOKING_FOR",				"在我周围寻找: ");
define("_SEE_WIKIVOYAGE_GUIDES",	"在您周围有wiki电子导游信息.");
define("_YOUR_PATH",				"我的路线");
define("_CLEAR_CART",				"清除地图现有路线");
define("_SAVE_CART",				"保存地图 !");
define("_CART_IS_EMPTY_POPUP",		"您的地图为空，请在导出前加入景点和路线;)");
define("_YOU_ARE_HERE",				"您在这里 !");
define("_CENTER_BUTTON",			"以我的位置为中央显示");
define("_ERROR_API",				"An error occured while contacting the API. You may have asked for too many POI. <a href=\"index.php\">Go back to homepage and retry!</a>");
define("_LOAD_SIMPLIFIED",			"Experimenting troubles with the map ? Load the simplified version !");

//===> paths.php
define("_CONNECT_NECESS",			"您需要登录以便使用此项功能");
define("_REGISTRATION",				"点击这里用您的维基账户登录！!");
define("_YOUR_PATHS",				"您的路径");
define("_LOAD",						"载入");
define("_REMOVE",					"移除");
define("_NO_PATHS_SAVED",			"没有可保存的路径!");
define("_LOGOUT",					"登出");

//===> map_export.php
define("_PATH_HEADER",				"在保存您的路径前需要更多的信息!");
define("_PATH_TITLE",				"添加名称和描述");
define("_PATH_NAME",				"名称:");
define("_PATH_DESC",				"描述:");
define("_PATH_IMG",					"选择一个用于提醒您的照片");
define("_PATH_LOGIN",				"点击这里用您的维基账户注册");
