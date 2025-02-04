--TEST--
rect group test, procedural mode
--SKIPIF--
<?php
require 'test-functions.php';
--FILE--
<?php
echo "+++ Empty (true)\n";
$r = new SDL_Rect(0,0,0,0);
var_dump($r);
var_dump(SDL_RectEmpty($r));

$r = new SDL_FRect(.0,.0,.0,.0);
var_dump($r);
var_dump(SDL_FRectEmpty($r));

echo "+++ Empty (false)\n";
$r = new SDL_Rect(1,2,3,4);
var_dump($r);
var_dump(SDL_RectEmpty($r));

$r = new SDL_FRect(1.0,2.0,3.0,4.0);
var_dump($r);
var_dump(SDL_FRectEmpty($r));

$r1 = new SDL_Rect(10,10,20,20);
$r2 = new SDL_Rect(10,10,20,20);
$r3 = new SDL_Rect(16,17,22,24);
$r4 = new SDL_Rect(100,10,20,20);

$fr2 = new SDL_FRect(10.1, 10.1, 20.1, 20.1);
$fr3 = new SDL_FRect(16.1, 17.1, 22.1, 24.1);
$fr4 = new SDL_FRect(100.1, 10.1, 20.1, 20.1);

echo "+++ Equal (true)\n";
var_dump(SDL_RectEquals($r1, $r1));
var_dump(SDL_RectEquals($r1, $r2));
echo "+++ Equal (false)\n";
var_dump(SDL_RectEquals($r1, $r3));
var_dump(SDL_RectEquals($r2, $r3));

echo "+++ Inter (true)\n";
var_dump(SDL_HasIntersection($r2, $r3));
var_dump(SDL_IntersectRect($r2, $r3, $x));
var_dump($x); unset($x);

var_dump(SDL_HasIntersectionF($fr2, $fr3));
var_dump(SDL_IntersectFRect($fr2, $fr3, $x));
var_dump($x); unset($x);

echo "+++ Inter (false)\n";
var_dump(SDL_HasIntersection($r2, $r4));
var_dump(SDL_IntersectRect($r2, $r4, $x));
var_dump($x); unset($x);

var_dump(SDL_HasIntersectionF($fr2, $fr4));
var_dump(SDL_IntersectFRect($fr2, $fr4, $x));
var_dump($x); unset($x);

echo "+++ Union\n";
var_dump(SDL_UnionRect($r2, $r3, $x));
var_dump($x); unset($x);
var_dump(SDL_UnionRect($r2, $r4, $x));
var_dump($x); unset($x);

echo "+++ InterLine\n";
$x1=0; $y1=10; $x2=40; $y2=30;
var_dump(SDL_IntersectRectAndLine($r1, $x1, $y1, $x2, $y2));
var_dump($x1, $y1, $x2, $y2);
$x1=0; $y1=2; $x2=40; $y2=6;
var_dump(SDL_IntersectRectAndLine($r1, $x1, $y1, $x2, $y2));

echo "+++ EnclosePoints\n";
$pts = array(
	new SDL_Point(20,14),
	new SDL_Point(13,20),
	new SDL_Point(24,20),
	new SDL_Point(20,28),
);
var_dump($pts[0]." ".$pts[1]." ".$pts[2]." ".$pts[3]);
var_dump(SDL_EnclosePoints($pts, 0, $r1, $res1), $res1);
$pts[]="foo";
var_dump(SDL_EnclosePoints($pts, 6, $r4, $res2), $res2);

echo "+++ SDL_FRect\n";
$r = new SDL_FRect(1.1, 2.2, 3.3, 4.4);
var_dump($r);

echo "+++ SDL_FPoint\n";
$r = new SDL_FPoint(1.1, 2.2);
var_dump($r);

?>
Done
--EXPECTF--
+++ Empty (true)
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(0)
  ["y"]=>
  int(0)
  ["w"]=>
  int(0)
  ["h"]=>
  int(0)
}
bool(true)
object(SDL_FRect)#%d (4) {
  ["x"]=>
  float(0)
  ["y"]=>
  float(0)
  ["w"]=>
  float(0)
  ["h"]=>
  float(0)
}
bool(true)
+++ Empty (false)
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(1)
  ["y"]=>
  int(2)
  ["w"]=>
  int(3)
  ["h"]=>
  int(4)
}
bool(false)
object(SDL_FRect)#%d (4) {
  ["x"]=>
  float(1)
  ["y"]=>
  float(2)
  ["w"]=>
  float(3)
  ["h"]=>
  float(4)
}
bool(false)
+++ Equal (true)
bool(true)
bool(true)
+++ Equal (false)
bool(false)
bool(false)
+++ Inter (true)
bool(true)
bool(true)
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(16)
  ["y"]=>
  int(17)
  ["w"]=>
  int(14)
  ["h"]=>
  int(13)
}
bool(true)
bool(true)
object(SDL_FRect)#%d (4) {
  ["x"]=>
  float(16.100000381469727)
  ["y"]=>
  float(17.100000381469727)
  ["w"]=>
  float(14.100000381469727)
  ["h"]=>
  float(13.100000381469727)
}
+++ Inter (false)
bool(false)
bool(false)
NULL
bool(false)
bool(false)
NULL
+++ Union
NULL
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(10)
  ["y"]=>
  int(10)
  ["w"]=>
  int(28)
  ["h"]=>
  int(31)
}
NULL
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(10)
  ["y"]=>
  int(10)
  ["w"]=>
  int(110)
  ["h"]=>
  int(20)
}
+++ InterLine
bool(true)
int(10)
int(15)
int(29)
int(24)
bool(false)
+++ EnclosePoints
string(67) "SDL_Point(20,14) SDL_Point(13,20) SDL_Point(24,20) SDL_Point(20,28)"
bool(true)
object(SDL_Rect)#%d (4) {
  ["x"]=>
  int(13)
  ["y"]=>
  int(14)
  ["w"]=>
  int(12)
  ["h"]=>
  int(15)
}

Warning: SDL_EnclosePoints(): point #4 is not a SDL_Point object in %s/006-rect.php on line %d

Warning: SDL_EnclosePoints(): point #5 missing in %s/006-rect.php on line %d
bool(false)
NULL
+++ SDL_FRect
object(SDL_FRect)#%d (4) {
  ["x"]=>
  float(1.1)
  ["y"]=>
  float(2.2)
  ["w"]=>
  float(3.3)
  ["h"]=>
  float(4.4)
}
+++ SDL_FPoint
object(SDL_FPoint)#2 (2) {
  ["x"]=>
  float(1.1)
  ["y"]=>
  float(2.2)
}
Done

