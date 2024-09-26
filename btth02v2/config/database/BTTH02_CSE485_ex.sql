use BTTH02_CSE485
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


-- l)   Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web.
CREATE TABLE users (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
)


INSERT INTO users ('id', 'username', 'password') VALUES
('1', 'tuankien2704','123456')