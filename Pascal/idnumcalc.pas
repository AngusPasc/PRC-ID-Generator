unit IDNumCalc;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, MonthDaysCalc;
type InformationData = array of String;
function GetCheck(idNumber: String): Char;
function IsValidIDNum(idNumber: String): Boolean;
function GetNumberPlace(idNumber: String): String;
function GetInformationsFromIDNumber(idNumber: String): InformationData;
const NumberWeighingList: array[1..17] of Integer = (7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
const LastNumberIndex: array[0..10] of Char = ('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
implementation
function GetCheck(idNumber: String): Char;
var
  i: Integer;
  sumCalc: Integer;
begin
  if (Length(idNumber) < 17) or (Length(idNumber) > 18) then GetCheck := '?'
  else begin
    try
      sumCalc := 0;
      for i := 1 to 17 do sumCalc := StrToInt(idNumber[i]) * NumberWeighingList[i] + sumCalc;
      GetCheck := LastNumberIndex[sumCalc mod 11];
    except
      GetCheck := '?';
    end;
  end;
end;
function IsValidIDNum(idNumber: String): Boolean;
begin
  IsValidIDNum := False;
  if (Length(idNumber) = 18) and (idNumber[18] <> '?') then begin
    if IsValidDate(idNumber[7..14]) and (GetCheck(idNumber) = idNumber[18]) then IsValidIDNum := True;
  end;
end;
function GetNumberPlace(idNumber: String): String;
begin
  GetNumberPlace := 'Unknown';
end;
function GetInformationsFromIDNumber(idNumber: String): InformationData;
begin

end;

end.

