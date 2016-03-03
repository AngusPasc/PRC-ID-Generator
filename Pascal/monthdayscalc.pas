unit MonthDaysCalc;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils;

function GetMonthDays(year: Integer; month: Integer): Integer;
function IsValidDate(dateString: String): Boolean;
const MonthsHaving30Days: array[1..4] of Integer = (4, 6, 9, 11);

implementation
function GetMonthDays(year: Integer; month: Integer): Integer;
var
  i: Integer;
begin
  GetMonthDays := 0;
  if (month < 1) or (month > 12) then GetMonthDays := 0
  else begin
    for i := 1 to Length(MonthsHaving30Days) do begin
        if MonthsHaving30Days[i] = month then GetMonthDays := 30;
    end;
    if GetMonthDays = 0 then begin
      if month = 2 then begin
        if (year mod 100) = 0 then GetMonthDays := 29
        else begin
            if (year mod 4) = 0 then GetMonthDays := 29
            else GetMonthDays := 28;
        end;
        end else GetMonthDays := 31;
      end;
  end;
end;

function IsValidDate(dateString: String): Boolean;
begin
  if(Length(dateString) = 8) then begin
    try
      if GetMonthDays(StrToInt(dateString[1..4]), StrToInt(dateString[5..6])) < StrToInt(dateString[7..8]) then IsValidDate := False
      else IsValidDate := True;
    except
      IsValidDate := False;
    end;
  end else IsValidDate := False;
end;

end.

