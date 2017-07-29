# Host: Localhost  (Version 5.7.14)
# Date: 2017-07-29 23:32:10
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "banner"
#

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(50)      DEFAULT NULL
  COMMENT 'Banner名称，通常作为标识',
  `description` VARCHAR(255)     DEFAULT NULL
  COMMENT 'Banner描述',
  `delete_time` INT(11)          DEFAULT NULL,
  `update_time` INT(11)          DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4
  COMMENT ='banner管理表';

#
# Data for table "banner"
#

INSERT INTO `banner` VALUES (1, '首页置顶', '首页轮播图', NULL, NULL);

#
# Structure for table "banner_item"
#

DROP TABLE IF EXISTS `banner_item`;
CREATE TABLE `banner_item` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `img_id`      INT(11)      NOT NULL
  COMMENT '外键，关联image表',
  `key_word`    VARCHAR(100) NOT NULL
  COMMENT '执行关键字，根据不同的type含义不同',
  `type`        TINYINT(4)   NOT NULL DEFAULT '1'
  COMMENT '跳转类型，可能导向商品，可能导向专题，可能导向其他。0，无导向；1：导向商品;2:导向专题',
  `delete_time` INT(11)               DEFAULT NULL,
  `banner_id`   INT(11)      NOT NULL
  COMMENT '外键，关联banner表',
  `update_time` INT(11)               DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8mb4
  COMMENT ='banner子项表';

#
# Data for table "banner_item"
#

INSERT INTO `banner_item`
VALUES (1, 65, '6', 1, NULL, 1, NULL), (2, 2, '25', 1, NULL, 1, NULL), (3, 3, '11', 1, NULL, 1, NULL),
  (5, 1, '10', 1, NULL, 1, NULL);

#
# Structure for table "category"
#

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id`           INT(11)     NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(50) NOT NULL
  COMMENT '分类名称',
  `topic_img_id` INT(11)              DEFAULT NULL
  COMMENT '外键，关联image表',
  `delete_time`  INT(11)              DEFAULT NULL,
  `description`  VARCHAR(100)         DEFAULT NULL
  COMMENT '描述',
  `update_time`  INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 8
  DEFAULT CHARSET = utf8mb4
  COMMENT ='商品类目';

#
# Data for table "category"
#

INSERT INTO `category`
VALUES (2, '果味', 6, NULL, NULL, NULL), (3, '蔬菜', 5, NULL, NULL, NULL), (4, '炒货', 7, NULL, NULL, NULL),
  (5, '点心', 4, NULL, NULL, NULL), (6, '粗茶', 8, NULL, NULL, NULL), (7, '淡饭', 9, NULL, NULL, NULL);

#
# Structure for table "image"
#

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `url`         VARCHAR(255) NOT NULL
  COMMENT '图片路径',
  `from`        TINYINT(4)   NOT NULL DEFAULT '1'
  COMMENT '1 来自本地，2 来自公网',
  `delete_time` INT(11)               DEFAULT NULL,
  `update_time` INT(11)               DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 70
  DEFAULT CHARSET = utf8mb4
  COMMENT ='图片总表';

#
# Data for table "image"
#

INSERT INTO `image`
VALUES (1, '/banner-1a.png', 1, NULL, NULL), (2, '/banner-2a.png', 1, NULL, NULL), (3, '/banner-3a.png', 1, NULL, NULL),
  (4, '/category-cake.png', 1, NULL, NULL), (5, '/category-vg.png', 1, NULL, NULL),
  (6, '/category-dryfruit.png', 1, NULL, NULL), (7, '/category-fry-a.png', 1, NULL, NULL),
  (8, '/category-tea.png', 1, NULL, NULL), (9, '/category-rice.png', 1, NULL, NULL),
  (10, '/product-dryfruit@1.png', 1, NULL, NULL), (13, '/product-vg@1.png', 1, NULL, NULL),
  (14, '/product-rice@6.png', 1, NULL, NULL), (16, '/1@theme.png', 1, NULL, NULL), (17, '/2@theme.png', 1, NULL, NULL),
  (18, '/3@theme.png', 1, NULL, NULL), (19, '/detail-1@1-dryfruit.png', 1, NULL, NULL),
  (20, '/detail-2@1-dryfruit.png', 1, NULL, NULL), (21, '/detail-3@1-dryfruit.png', 1, NULL, NULL),
  (22, '/detail-4@1-dryfruit.png', 1, NULL, NULL), (23, '/detail-5@1-dryfruit.png', 1, NULL, NULL),
  (24, '/detail-6@1-dryfruit.png', 1, NULL, NULL), (25, '/detail-7@1-dryfruit.png', 1, NULL, NULL),
  (26, '/detail-8@1-dryfruit.png', 1, NULL, NULL), (27, '/detail-9@1-dryfruit.png', 1, NULL, NULL),
  (28, '/detail-11@1-dryfruit.png', 1, NULL, NULL), (29, '/detail-10@1-dryfruit.png', 1, NULL, NULL),
  (31, '/product-rice@1.png', 1, NULL, NULL), (32, '/product-tea@1.png', 1, NULL, NULL),
  (33, '/product-dryfruit@2.png', 1, NULL, NULL), (36, '/product-dryfruit@3.png', 1, NULL, NULL),
  (37, '/product-dryfruit@4.png', 1, NULL, NULL), (38, '/product-dryfruit@5.png', 1, NULL, NULL),
  (39, '/product-dryfruit-a@6.png', 1, NULL, NULL), (40, '/product-dryfruit@7.png', 1, NULL, NULL),
  (41, '/product-rice@2.png', 1, NULL, NULL), (42, '/product-rice@3.png', 1, NULL, NULL),
  (43, '/product-rice@4.png', 1, NULL, NULL), (44, '/product-fry@1.png', 1, NULL, NULL),
  (45, '/product-fry@2.png', 1, NULL, NULL), (46, '/product-fry@3.png', 1, NULL, NULL),
  (47, '/product-tea@2.png', 1, NULL, NULL), (48, '/product-tea@3.png', 1, NULL, NULL),
  (49, '/1@theme-head.png', 1, NULL, NULL), (50, '/2@theme-head.png', 1, NULL, NULL),
  (51, '/3@theme-head.png', 1, NULL, NULL), (52, '/product-cake@1.png', 1, NULL, NULL),
  (53, '/product-cake@2.png', 1, NULL, NULL), (54, '/product-cake-a@3.png', 1, NULL, NULL),
  (55, '/product-cake-a@4.png', 1, NULL, NULL), (56, '/product-dryfruit@8.png', 1, NULL, NULL),
  (57, '/product-fry@4.png', 1, NULL, NULL), (58, '/product-fry@5.png', 1, NULL, NULL),
  (59, '/product-rice@5.png', 1, NULL, NULL), (60, '/product-rice@7.png', 1, NULL, NULL),
  (62, '/detail-12@1-dryfruit.png', 1, NULL, NULL), (63, '/detail-13@1-dryfruit.png', 1, NULL, NULL),
  (65, '/banner-4a.png', 1, NULL, NULL), (66, '/product-vg@4.png', 1, NULL, NULL),
  (67, '/product-vg@5.png', 1, NULL, NULL), (68, '/product-vg@2.png', 1, NULL, NULL),
  (69, '/product-vg@3.png', 1, NULL, NULL);

#
# Structure for table "order"
#

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `order_no`     VARCHAR(20)   NOT NULL
  COMMENT '订单号',
  `user_id`      INT(11)       NOT NULL
  COMMENT '外键，用户id，注意并不是openid',
  `delete_time`  INT(11)                DEFAULT NULL,
  `create_time`  INT(11)                DEFAULT NULL,
  `total_price`  DECIMAL(6, 2) NOT NULL,
  `status`       TINYINT(4)    NOT NULL DEFAULT '1'
  COMMENT '1:未支付， 2：已支付，3：已发货 , 4: 已支付，但库存不足',
  `snap_img`     VARCHAR(255)           DEFAULT NULL
  COMMENT '订单快照图片',
  `snap_name`    VARCHAR(80)            DEFAULT NULL
  COMMENT '订单快照名称',
  `total_count`  INT(11)       NOT NULL DEFAULT '0',
  `update_time`  INT(11)                DEFAULT NULL,
  `snap_items`   TEXT COMMENT '订单其他信息快照（json)',
  `snap_address` VARCHAR(500)           DEFAULT NULL
  COMMENT '地址快照',
  `prepay_id`    VARCHAR(100)           DEFAULT NULL
  COMMENT '订单微信支付的预订单id（用于发送模板消息）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`),
  KEY `user_id` (`user_id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "order"
#

INSERT INTO `order` VALUES
  (3, 'A729371381619074', 1, NULL, 1501337137, 0.05, 1, 'http://z.cn/images/product-vg@1.png', '芹菜 半斤等', 5, 1501337137,
   '[{\"id\":1,\"haveStock\":true,\"count\":3,\"name\":\"\\u82b9\\u83dc \\u534a\\u65a4\",\"totalPrice\":0.03},{\"id\":2,\"haveStock\":true,\"count\":2,\"name\":\"\\u68a8\\u82b1\\u5e26\\u96e8 3\\u4e2a\",\"totalPrice\":0.02}]',
   '{\"id\":1,\"name\":\"Vincent\",\"mobile\":\"13145209353\",\"province\":\"\\u8d35\\u5dde\\u7701\",\"city\":\"\\u8d35\\u9633\\u5e02\",\"country\":\"\\u8d35\\u5b89\\u65b0\\u533a\",\"detail\":\"\\u8d35\\u5b89\\u521b\\u5ba2\\u8054\\u76df\"}',
   NULL);

#
# Structure for table "order_product"
#

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `order_id`    INT(11) NOT NULL
  COMMENT '联合主键，订单id',
  `product_id`  INT(11) NOT NULL
  COMMENT '联合主键，商品id',
  `count`       INT(11) NOT NULL
  COMMENT '商品数量',
  `delete_time` INT(11) DEFAULT NULL,
  `update_time` INT(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`, `order_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "order_product"
#

INSERT INTO `order_product` VALUES (3, 1, 3, NULL, NULL), (3, 2, 2, NULL, NULL);

#
# Structure for table "product"
#

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(80)   NOT NULL
  COMMENT '商品名称',
  `price`        DECIMAL(6, 2) NOT NULL
  COMMENT '价格,单位：分',
  `stock`        INT(11)       NOT NULL DEFAULT '0'
  COMMENT '库存量',
  `delete_time`  INT(11)                DEFAULT NULL,
  `category_id`  INT(11)                DEFAULT NULL,
  `main_img_url` VARCHAR(255)           DEFAULT NULL
  COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
  `from`         TINYINT(4)    NOT NULL DEFAULT '1'
  COMMENT '图片来自 1 本地 ，2公网',
  `create_time`  INT(11)                DEFAULT NULL
  COMMENT '创建时间',
  `update_time`  INT(11)                DEFAULT NULL,
  `summary`      VARCHAR(50)            DEFAULT NULL
  COMMENT '摘要',
  `img_id`       INT(11)                DEFAULT NULL
  COMMENT '图片外键',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 34
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "product"
#

INSERT INTO `product` VALUES (1, '芹菜 半斤', 0.01, 998, NULL, 3, '/product-vg@1.png', 1, 1499920806, NULL, '', 13),
  (2, '梨花带雨 3个', 0.01, 998, NULL, 2, '/product-dryfruit@1.png', 1, 1499920900, NULL, NULL, 10),
  (3, '素米 327克', 0.01, 996, NULL, 7, '/product-rice@1.png', 1, 1499921000, NULL, NULL, 31),
  (4, '红袖枸杞 6克*3袋', 0.01, 998, NULL, 6, '/product-tea@1.png', 1, 1499922060, NULL, NULL, 32),
  (5, '春生龙眼 500克', 0.01, 995, NULL, 2, '/product-dryfruit@2.png', 1, 1499922476, NULL, NULL, 33),
  (6, '小红的猪耳朵 120克', 0.01, 997, NULL, 5, '/product-cake@2.png', 1, NULL, NULL, NULL, 53),
  (7, '泥蒿 半斤', 0.01, 998, NULL, 3, '/product-vg@2.png', 1, NULL, NULL, NULL, 68),
  (8, '夏日芒果 3个', 0.01, 995, NULL, 2, '/product-dryfruit@3.png', 1, NULL, NULL, NULL, 36),
  (9, '冬木红枣 500克', 0.01, 996, NULL, 2, '/product-dryfruit@4.png', 1, NULL, NULL, NULL, 37),
  (10, '万紫千凤梨 300克', 0.01, 996, NULL, 2, '/product-dryfruit@5.png', 1, NULL, NULL, NULL, 38),
  (11, '贵妃笑 100克', 0.01, 994, NULL, 2, '/product-dryfruit-a@6.png', 1, NULL, NULL, NULL, 39),
  (12, '珍奇异果 3个', 0.01, 999, NULL, 2, '/product-dryfruit@7.png', 1, NULL, NULL, NULL, 40),
  (13, '绿豆 125克', 0.01, 999, NULL, 7, '/product-rice@2.png', 1, NULL, NULL, NULL, 41),
  (14, '芝麻 50克', 0.01, 999, NULL, 7, '/product-rice@3.png', 1, NULL, NULL, NULL, 42),
  (15, '猴头菇 370克', 0.01, 999, NULL, 7, '/product-rice@4.png', 1, NULL, NULL, NULL, 43),
  (16, '西红柿 1斤', 0.01, 999, NULL, 3, '/product-vg@3.png', 1, NULL, NULL, NULL, 69),
  (17, '油炸花生 300克', 0.01, 999, NULL, 4, '/product-fry@1.png', 1, NULL, NULL, NULL, 44),
  (18, '春泥西瓜子 128克', 0.01, 997, NULL, 4, '/product-fry@2.png', 1, NULL, NULL, NULL, 45),
  (19, '碧水葵花籽 128克', 0.01, 999, NULL, 4, '/product-fry@3.png', 1, NULL, NULL, NULL, 46),
  (20, '碧螺春 12克*3袋', 0.01, 999, NULL, 6, '/product-tea@2.png', 1, NULL, NULL, NULL, 47),
  (21, '西湖龙井 8克*3袋', 0.01, 998, NULL, 6, '/product-tea@3.png', 1, NULL, NULL, NULL, 48),
  (22, '梅兰清花糕 1个', 0.01, 997, NULL, 5, '/product-cake-a@3.png', 1, NULL, NULL, NULL, 54),
  (23, '清凉薄荷糕 1个', 0.01, 998, NULL, 5, '/product-cake-a@4.png', 1, NULL, NULL, NULL, 55),
  (25, '小明的妙脆角 120克', 0.01, 999, NULL, 5, '/product-cake@1.png', 1, NULL, NULL, NULL, 52),
  (26, '红衣青瓜 混搭160克', 0.01, 999, NULL, 2, '/product-dryfruit@8.png', 1, NULL, NULL, NULL, 56),
  (27, '锈色瓜子 100克', 0.01, 998, NULL, 4, '/product-fry@4.png', 1, NULL, NULL, NULL, 57),
  (28, '春泥花生 200克', 0.01, 999, NULL, 4, '/product-fry@5.png', 1, NULL, NULL, NULL, 58),
  (29, '冰心鸡蛋 2个', 0.01, 999, NULL, 7, '/product-rice@5.png', 1, NULL, NULL, NULL, 59),
  (30, '八宝莲子 200克', 0.01, 999, NULL, 7, '/product-rice@6.png', 1, NULL, NULL, NULL, 14),
  (31, '深涧木耳 78克', 0.01, 999, NULL, 7, '/product-rice@7.png', 1, NULL, NULL, NULL, 60),
  (32, '土豆 半斤', 0.01, 999, NULL, 3, '/product-vg@4.png', 1, NULL, NULL, NULL, 66),
  (33, '青椒 半斤', 0.01, 999, NULL, 3, '/product-vg@5.png', 1, NULL, NULL, NULL, 67);

#
# Structure for table "product_image"
#

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE `product_image` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `img_id`      INT(11) NOT NULL
  COMMENT '外键，关联图片表',
  `delete_time` INT(11)          DEFAULT NULL
  COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
  `order`       INT(11) NOT NULL DEFAULT '0'
  COMMENT '图片排序序号',
  `product_id`  INT(11) NOT NULL
  COMMENT '商品id，外键',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 20
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "product_image"
#

INSERT INTO `product_image`
VALUES (4, 19, NULL, 1, 11), (5, 20, NULL, 2, 11), (6, 21, NULL, 3, 11), (7, 22, NULL, 4, 11), (8, 23, NULL, 5, 11),
  (9, 24, NULL, 6, 11), (10, 25, NULL, 7, 11), (11, 26, NULL, 8, 11), (12, 27, NULL, 9, 11), (13, 28, NULL, 11, 11),
  (14, 29, NULL, 10, 11), (18, 62, NULL, 12, 11), (19, 63, NULL, 13, 11);

#
# Structure for table "product_property"
#

DROP TABLE IF EXISTS `product_property`;
CREATE TABLE `product_property` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(30)           DEFAULT ''
  COMMENT '详情属性名称',
  `detail`      VARCHAR(255) NOT NULL
  COMMENT '详情属性',
  `product_id`  INT(11)      NOT NULL
  COMMENT '商品id，外键',
  `delete_time` INT(11)               DEFAULT NULL,
  `update_time` INT(11)               DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "product_property"
#

INSERT INTO `product_property`
VALUES (1, '品名', '杨梅', 11, NULL, NULL), (2, '口味', '青梅味 雪梨味 黄桃味 菠萝味', 11, NULL, NULL), (3, '产地', '火星', 11, NULL, NULL),
  (4, '保质期', '180天', 11, NULL, NULL), (5, '品名', '梨子', 2, NULL, NULL), (6, '产地', '金星', 2, NULL, NULL),
  (7, '净含量', '100g', 2, NULL, NULL), (8, '保质期', '10天', 2, NULL, NULL);

#
# Structure for table "theme"
#

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id`           INT(11)     NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(50) NOT NULL
  COMMENT '专题名称',
  `description`  VARCHAR(255)         DEFAULT NULL
  COMMENT '专题描述',
  `topic_img_id` INT(11)     NOT NULL
  COMMENT '主题图，外键',
  `delete_time`  INT(11)              DEFAULT NULL,
  `head_img_id`  INT(11)     NOT NULL
  COMMENT '专题列表页，头图',
  `update_time`  INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COMMENT ='主题信息表';

#
# Data for table "theme"
#

INSERT INTO `theme` VALUES (1, '专题栏位一', '美味水果世界', 16, NULL, 49, NULL), (2, '专题栏位二', '新品推荐', 17, NULL, 50, NULL),
  (3, '专题栏位三', '做个干物女', 18, NULL, 18, NULL);

#
# Structure for table "theme_product"
#

DROP TABLE IF EXISTS `theme_product`;
CREATE TABLE `theme_product` (
  `theme_id`   INT(11) NOT NULL
  COMMENT '主题外键',
  `product_id` INT(11) NOT NULL
  COMMENT '商品外键',
  PRIMARY KEY (`theme_id`, `product_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COMMENT ='主题所包含的商品';

#
# Data for table "theme_product"
#

INSERT INTO `theme_product`
VALUES (1, 2), (1, 5), (1, 8), (1, 10), (1, 12), (2, 1), (2, 2), (2, 3), (2, 5), (2, 6), (2, 16), (2, 33), (3, 15),
  (3, 18), (3, 19), (3, 27), (3, 30), (3, 31);

#
# Structure for table "third_app"
#

DROP TABLE IF EXISTS `third_app`;
CREATE TABLE `third_app` (
  `id`                INT(11)     NOT NULL AUTO_INCREMENT,
  `app_id`            VARCHAR(64) NOT NULL
  COMMENT '应用app_id',
  `app_secret`        VARCHAR(64) NOT NULL
  COMMENT '应用secret',
  `app_description`   VARCHAR(100)         DEFAULT NULL
  COMMENT '应用程序描述',
  `scope`             VARCHAR(20) NOT NULL
  COMMENT '应用权限',
  `scope_description` VARCHAR(100)         DEFAULT NULL
  COMMENT '权限描述',
  `delete_time`       INT(11)              DEFAULT NULL,
  `update_time`       INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4
  COMMENT ='访问API的各应用账号密码表';

#
# Data for table "third_app"
#

INSERT INTO `third_app` VALUES (1, 'starcraft', '777*777', 'CMS', '32', 'Super', NULL, NULL);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id`          INT(11)     NOT NULL AUTO_INCREMENT,
  `openid`      VARCHAR(50) NOT NULL,
  `nickname`    VARCHAR(50)          DEFAULT NULL,
  `extend`      VARCHAR(255)         DEFAULT NULL,
  `delete_time` INT(11)              DEFAULT NULL,
  `create_time` INT(11)              DEFAULT NULL
  COMMENT '注册时间',
  `update_time` INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1, 'oHlHw0OVUVtVE7k9lb7xxxi_N8TE', NULL, NULL, NULL, NULL, NULL);

#
# Structure for table "user_address"
#

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id`          INT(11)     NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(30) NOT NULL
  COMMENT '收获人姓名',
  `mobile`      VARCHAR(20) NOT NULL
  COMMENT '手机号',
  `province`    VARCHAR(20)          DEFAULT NULL
  COMMENT '省',
  `city`        VARCHAR(20)          DEFAULT NULL
  COMMENT '市',
  `country`     VARCHAR(20)          DEFAULT NULL
  COMMENT '区',
  `detail`      VARCHAR(100)         DEFAULT NULL
  COMMENT '详细地址',
  `delete_time` INT(11)              DEFAULT NULL,
  `user_id`     INT(11)     NOT NULL
  COMMENT '外键',
  `update_time` INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4;

#
# Data for table "user_address"
#

INSERT INTO `user_address` VALUES (1, 'Vincent', '13145209353', '贵州省', '贵阳市', '贵安新区', '贵安创客联盟', NULL, 1, NULL);
