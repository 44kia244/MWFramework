INSERT INTO `authorization` (`G_ID`, `P_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3);

INSERT INTO `groups` (`G_ID`, `G_NAME`) VALUES
(1, 'Administrator'),
(2, 'Content Owner');

INSERT INTO `permissions` (`P_ID`, `P_DESC`) VALUES
(1, 'Blog Post'),
(2, 'Blog Edit (Own)'),
(3, 'Blog Delete (Own)'),
(4, 'Blog Edit / Delete (Everyone)');

INSERT INTO `userdata` (`USER_ID`, `NAME`, `SURNAME`, `ADDRESS`, `TELEPHONE`, `G_ID`) VALUES
(1, 'Test', 'Administrator', 'Somewhere', '0812345678', 1);

INSERT INTO `users` (`USER_ID`, `USER_USERNAME`, `USER_PASSWORD`) VALUES
(1, 'admin', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db');
