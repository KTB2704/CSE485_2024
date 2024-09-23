create database  BTTH01_CSE485
use  BTTH01_CSE485
create table tacgia
(
	ma_tgia int AUTO_INCREMENT not null primary key,
	ten_tgia varchar(100) not null,
	hinh_tgia varchar(100)
)
create table theloai
(
	ma_tloai int AUTO_INCREMENT not null  primary key,
	ten_tloai varchar(50) not null
)

drop table tacgia
create table baiviet
(
	ma_bviet int AUTO_INCREMENT not null primary key,
	tieude varchar(200) not null,
	ten_bhat varchar(100) not null,
	ma_tloai int not null,
	tomtat text not null,
	noidung text,
	ma_tgia int,
	ngayviet datetime default CURRENT_TIMESTAMP,
	hinhanh varchar(200),
	foreign key(ma_tloai) references theloai(ma_tloai),
	foreign key(ma_tgia) references tacgia(ma_tgia)
)
INSERT INTO theloai VALUES (1, N'Nhạc trẻ');
INSERT INTO theloai VALUES (2, N'Nhạc trữ tình');
INSERT INTO theloai VALUES (3, N'Nhạc cách mạng');
INSERT INTO theloai VALUES (4, N'Nhạc thiếu nhi');
INSERT INTO theloai VALUES (5, N'Nhạc quê hương');
INSERT INTO theloai VALUES (6, 'POP');
INSERT INTO theloai VALUES (7, 'Rock');
INSERT INTO theloai VALUES (8, 'R&B');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
1, 
N'Lòng mẹ', N'Lòng mẹ', 2,
N'Và mẹ ơi đừng khóc nhé! Cả đời này mẹ đã khóc nhiều lắm rồi, hãy cười lên vì con đã trưởng thành! Con sẽ lại về dậy sớm nấu cơm cho mẹ, nấu nước cho mẹ tắm như ngày xưa. \“Dù cho vai nắng nhưng lòng thương chẳng nhạt màu, vẫn mơ quay về vui vầy dưới bóng mẹ yêu\”', 	
1, '2012/7/23'
);

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
2, 
N'Cảm ơn em đã rời xa anh', N'Vết mưa', 2,
N'Cảm ơn em đã cho anh những tháng ngày hạnh phúc, cho anh biết yêu và được yêu. Em cho anh được nếm trải hương vị ngọt ngào của tình yêu nhưng cũng đầy đau khổ và nước mắt. Những tháng ngày đó có lẽ suốt cuộc đời anh không bao giờ quên', 	
3, '2012/2/12'
);



INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
3,
N'Cuộc đời có mấy ngày mai?', N'Phôi pha', 2, 
N'Đêm nay, trời quang mây tạnh, trong người nghe hoang vắng và tôi ngồi đây \“Ôm lòng đêm, Nhìn vầng trăng mới về\” mà ngậm ngùi \“Nhớ chân giang hồ. Ôi phù du, từng tuổi xuân đã già\”', 
4, '2014/3/13'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
4, 
N'Quê tôi!', N'Quê hương', 5,
N'Quê hương là gì mà chở đầy kí ức nhỏ xinh. Có đám trẻ nô đùa bên nhau dưới gốc ổi nhà bà Năm giữa trưa nắng gắt chỉ để chờ bà đi vắng là hái trộm. Có hai anh em tôi bì bõm lội sình bắt cua đem về nhà cho mẹ nấu canh, nấu cháo… Có ba chị em tôi lục đục tự nấu ăn khi mẹ vắng nhà. Có anh tôi luôn dắt tôi đi cùng đường ngõ xóm chỉ để em được vui. Có cả những trận cãi nhau nảy lửa của ba anh em nữa…',
5, '2014/2/20'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
5, 
N'Đất nước', N'Đất nước', 5,
N'Đã bao nhiêu lần tôi tự hỏi: liệu trên Thế giới này có nơi nào chiến tranh tang thương mà lại rất đổi anh hùng như nước mình không? Liệu có mảnh đất nào mà mỗi tấc đất hôm nay đã thấm máu xương của những thế hệ đi trước nhiều như nước mình không? Và, liệu có một đất nước nào lại có nhiều bà mẹ đau khổ nhưng cũng hết sức gan góc như đất nước mình không?',
1, '2010/5/25'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
6, 
'Hard Rock Hallelujah', 'Hard Rock Hallelujah', 7,
N'Những linh hồn đang lạc lối, mù quáng mất phương hướng trong cõi trần gian đầy nghiệt ngã hãy nên lắng nghe \"Hard Rock Hallelujah\" để có thể quên tất cả mọi thứ để tìm về đúng bản chất sâu thẳm nhất trong tâm hồn chính mình!',
6, '2013/9/12'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
7, 
'The Unforgiven', 'The Unforgiven', 7,
N'Lâu lắm rồi mới nghe lại The Unforgiven II, vì bài này không phải là bài mà tôi thích. Anh bạn tôi lúc trước, đi đâu cũng nghêu ngao bài này ấy, chỉ tại vì hắn đang... thất tình mà lị. Mà sao Metallica có The Unforgiven rồi lại có thêm bài này chi nữa vậy không biết nữa, làm cho tôi cảm thấy hình như hơi bị đúng so với tâm trạng của tôi lúc này.',
1, '2010/5/25'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
8, 
N'Nơi tình yêu bắt đầu', N'Nơi tình yêu bắt đầu', 1,
N'Nhiều người sẽ nghĩ làm gì có yêu nhất và làm gì có yêu mãi. Ừ! Chẳng có gì là mãi mãi cả, vì chúng ta không trường tồn vĩnh cửu',
1, '2014/2/3'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
9, 
'Love Me Like There’s No Tomorrow', 'Love Me Like There’s No Tomorrow', 8,
N'Nếu ai đã từng yêu Queen, yêu cái chất giọng cao, sắc sảo như một vết cắt thật ngọt ẩn giấu bao cảm xúc mãnh liệt của Freddie chắc không thể không \"điêu đứng\" mỗi khi nghe Love Me Like There’s No Tomorrow.',
1, '2013/2/26'
);

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
10, 
'I\m stronger', 'I\m stronger', 7,
N'Em không phải là người giỏi giấu cảm xúc, nhưng em lại là người giỏi đoán biết cảm xúc của người khác vậy nên đừng cố nói nhớ em, rằng mọi thứ chỉ là do hoàn cảnh. Và cũng đừng dối em rằng anh đã từng yêu em. Em nhắm mắt cũng cảm nhận được mà, thật đấy',
2, '2013/8/21'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
11, 
N'Ôi Cuộc Sống Mến Thương', N'Ôi Cuộc Sống Mến Thương', 5,
N'Có một câu nói như thế này \"Âm nhạc là một cái gì khác lạ mà hầu như tôi muốn nói nó là một phép thần diệu.Vì nó đứng giữa tư tưởng và hiện tượng, tinh thần và vật chất, mọi thứ trung gian mơ hồ thế đó mà không là thế đó giữa các sự vật mà âm nhạc hòa giải\"',
2, '2011/10/9'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
12, 
N'Cây và gió', N'Cây và gió', 7,
N'Em và anh, hai đứa quen nhau thật tình cờ. Lời hát của anh từ bài hát “Cây và gió” đã làm tâm hồn em xao động. Nhưng sự thật phũ phàng rằng em chưa bao giờ nói cho anh biết những suy nghĩ tận sâu trong tim mình. Bởi vì em nhút nhát, em không dám đối mặt với thực tế khắc nghiệt, hay thực ra em không dám đối diện với chính mình.',
7, '2013/12/5'
);


INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (
13,
N'Như một cách tạ ơn đời', N'Người thầy', 2,
N'Ánh nắng cuối ngày rồi cũng sẽ tắt, dòng sông con đò rồi cũng sẽ rẽ sang một hướng khác. Nhưng việc trồng người luôn cảm thụ với chuyến đò ngang, cứ tần tảo đưa rồi lặng lẽ quay về đưa sang. Con đò năm xưa của Thầy nặng trĩu yêu thương, hy sinh thầm lặng.',
8, '2014/1/2'
);

INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (1, 'Nhacvietplus');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (2, N'Sưu tầm');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (3, 'Sandy');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (4, N'Lê Trung Ngân');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (5, N'Khánh Ngọc');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (6, 'Night Stalker');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (7, N'Phạm Phương Anh');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (8, N'Tâm tình');


-- a) Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
select * 
from baiviet
inner join theloai
on baiviet.ma_tloai = theloai.ma_tloai
where ten_tloai = N'Nhạc Trữ Tình'

-- b) Liệt kê các bài viết của tác giả “Nhacvietplus”
select * 
from baiviet
inner join tacgia
on baiviet.ma_tgia = tacgia.ma_tgia
where ten_tgia = 'Nhacvietplus'

-- c) Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào.
select *
from theloai
left join baiviet 
on theloai.ma_tloai = baiviet.ma_tloai
where baiviet.ma_bviet IS NULL;

-- d) Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết.
select ma_bviet, tieude, ten_bhat, ten_tgia, ten_tloai, ngayviet
from baiviet
inner join tacgia
on baiviet.ma_tgia = tacgia.ma_tgia
inner join theloai
on baiviet.ma_tloai = theloai.ma_tloai

-- e) Tìm thể loại có số bài viết nhiều nhất
select ten_tloai, count(*) as 'so bai viet'
from baiviet
inner join theloai
on theloai.ma_tloai = baiviet.ma_tloai
group by ten_tloai
having count(*) >= all (select count(*) from baiviet group by ma_tloai)

-- f) Liệt kê 2 tác giả có số bài viết nhiều nhất
select ten_tgia, count(*) as 'so bai viet'
from tacgia
inner join baiviet
on tacgia.ma_tgia = baiviet.ma_tgia
group by ten_tgia
order by  'so bại viet' DESC
limit 2

-- g) Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
select * 
from baiviet
where ten_bhat like '%yêu%' or 
	  ten_bhat like '%thương%' or 
      ten_bhat like '%anh%' or 
      ten_bhat like '%em%'
      
-- h) Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
select *
from baiviet
where ten_bhat like '%yêu%' or 
	  ten_bhat like '%thương%' or 
      ten_bhat like '%anh%' or 
      ten_bhat like '%em%' or
	  tieude like '%yêu%' or 
	  tieude like '%thương%' or 
      tieude like '%anh%' or 
      tieude like '%em%'
-- i) Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả      
CREATE VIEW vw_Music AS
SELECT 
    b.ma_bviet AS 'Mã Bài Viết', 
    b.tieude AS 'Tiêu Đề', 
    b.ten_bhat AS 'Tên Bài Hát',
    t1.ten_tgia AS 'Tên Tác Giả',
    t2.ten_tloai AS 'Tên Thể Loại',
    b.ngayviet AS 'Ngày Viết'
FROM 
    baiviet b
INNER JOIN tacgia t1 ON b.ma_tgia = t1.ma_tgia
INNER JOIN theloai t2 ON b.ma_tloai = t2.ma_tloai

-- j) Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi.
DELIMITER $$
CREATE PROCEDURE sp_DSBaiViet(IN tentheloai VARCHAR(50))
BEGIN
  DECLARE v_count INT;

  SELECT COUNT(*) INTO v_count
  FROM theloai
  WHERE ten_tloai = tentheloai;

  IF v_count = 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Thể loại không tồn tại';
  ELSE
    SELECT b.ma_bviet, b.tieude, b.ten_bhat, t.ten_tgia
    FROM baiviet b
    INNER JOIN tacgia t ON b.ma_tgia = t.ma_tgia
    INNER JOIN theloai tl ON b.ma_tloai = tl.ma_tloai
    WHERE tl.ten_tloai = tentheloai;
  END IF;
END $$
DELIMITER ;

call sp_DSBaiViet ('Nhạc trữ tình');

-- k) Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo.
alter table theloai
add SLBaiViet int null


DELIMITER $$

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END $$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER tg_UpdateTheLoai
AFTER UPDATE ON baiviet
FOR EACH ROW
BEGIN
    -- Reduce count from the old category if it has changed
    IF OLD.ma_tloai != NEW.ma_tloai THEN
        UPDATE theloai
        SET SLBaiViet = SLBaiViet - 1
        WHERE ma_tloai = OLD.ma_tloai;

        -- Increase count for the new category
        UPDATE theloai
        SET SLBaiViet = SLBaiViet + 1
        WHERE ma_tloai = NEW.ma_tloai;
    END IF;
END $$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER tg_DeleteTheLoai
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END $$

DELIMITER ;


drop trigger tg_CapNhatTheLoai ;
show triggers

-- l)   Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web.
create table Users
(
	username varchar(100),
    password varchar(100),
    role varchar(100)
)

insert into Users value('tuankien2704', '1234456', 'ad');


