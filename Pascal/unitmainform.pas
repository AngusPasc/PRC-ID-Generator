unit UnitMainForm;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, FileUtil, Forms, Controls, Graphics, Dialogs,
  ExtCtrls, StdCtrls, IDNumCalc, MonthDaysCalc, PlacesList;

function MaskIntStr(originInt: Integer; needLength: Integer): String;

type

  { TMainForm }

  TMainForm = class(TForm)
    ButtonRandomAll: TButton;
    ButtonCheck: TButton;
    ButtonGenerate: TButton;
    EditOrderNumber: TEdit;
    GroupBoxGenderSelector: TGroupBox;
    LabeledEditPlaceNumber: TLabeledEdit;
    LabeledEditBirthDate: TLabeledEdit;
    LabeledEditIDNumber: TLabeledEdit;
    RadioButtonDefineOrderNumber: TRadioButton;
    RadioButtonGenderFemale: TRadioButton;
    RadioButtonGenderMale: TRadioButton;
    procedure ButtonCheckClick(Sender: TObject);
    procedure ButtonGenerateClick(Sender: TObject);
    procedure ButtonRandomAllClick(Sender: TObject);
    procedure RadioButtonDefineOrderNumberChange(Sender: TObject);
  private
    { private declarations }
  public
    { public declarations }
  end;

var
  MainForm: TMainForm;

implementation

function MaskIntStr(originInt: Integer; needLength: Integer): String;
var
  tempStr: String;
  originLength: Integer;
  i: Integer;
begin
  tempStr := IntToStr(originInt);
  originLength := Length(tempStr);
  if originLength < needLength then begin
    for i := 1 to needLength - originLength do tempStr := '0' + tempStr;
  end else tempStr := tempStr[1..needLength];
  Result := tempStr;
end;

{$R *.lfm}

{ TMainForm }

procedure TMainForm.ButtonGenerateClick(Sender: TObject);
var
  orderNum: Integer;
  checkNum: Char;
  tempNum: String;
begin
  Randomize;
  if RadioButtonDefineOrderNumber.Checked = True then begin
    try
      orderNum := StrToInt(EditOrderNumber.Text);
    except
      Application.MessageBox('请输入正确格式的顺序号码。', '提示信息');
      Exit;
    end;
  end else begin
      if RadioButtonGenderMale.Checked then orderNum := (Random(500) * 2 + 1)
      else orderNum := (Random(500) * 2);
  end;
  tempNum := LabeledEditPlaceNumber.Text + LabeledEditBirthDate.Text + MaskIntStr(orderNum, 3);
  checkNum := GetCheck(tempNum);
  if checkNum = '?' then Application.MessageBox('输入不正确，请检查输入。', '提示信息')
  else LabeledEditIDNumber.Text := tempNum + checkNum;
end;

procedure TMainForm.ButtonRandomAllClick(Sender: TObject);
var
  year: Integer;
  month: Integer;
begin
  Randomize;
  LabeledEditPlaceNumber.Text := IntToStr(placeNumbers[Random(Length(placeNumbers)) + 1]);
  year := StrToInt(FormatDateTime('YYYY', Now)) - Random(20) - 20;
  month := Random(12) + 1;
  LabeledEditBirthDate.Text := IntToStr(year) + MaskIntStr(month, 2) + MaskIntStr(Random(GetMonthDays(year, month)) + 1, 2);
  if Random(2) = 0 then RadioButtonGenderMale.Checked := True
  else RadioButtonGenderFemale.Checked := True;
  ButtonGenerateClick(Sender);
end;

procedure TMainForm.RadioButtonDefineOrderNumberChange(Sender: TObject);
begin
  if RadioButtonDefineOrderNumber.Checked then EditOrderNumber.Enabled := True
  else EditOrderNumber.Enabled := False;
end;

procedure TMainForm.ButtonCheckClick(Sender: TObject);
var
  msg: String;
  tempStr: String;
begin
  msg := '身份证号码：' + LabeledEditIDNumber.Text + #13;
  if IsValidIDNum(LabeledEditIDNumber.Text) then begin
    msg := msg + '号码校检通过' + #13;
    tempStr := GetNumberPlace(LabeledEditIDNumber.Text);
    if tempStr = '' then tempStr := '该地区在数据库中不存在';
    msg := msg + '所在地：' + tempStr;
  end else msg := '这不是一个有效的身份证号码！';
  Application.MessageBox(StrPCopy('', msg), '提示信息');
end;

end.

