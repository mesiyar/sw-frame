CREATE TABLE `t_pocket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `zb_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '账本类型',
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `create_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '发生时间',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_uq_user_id_create_time` (`user_id`,`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

