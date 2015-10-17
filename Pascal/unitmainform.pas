unit UnitMainForm;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, FileUtil, Forms, Controls, Graphics, Dialogs,
  ExtCtrls, StdCtrls, IDNumCalc;

function MaskIntStr(originInt: Integer; needLength: Integer): String;

type

  { TMainForm }

  TMainForm = class(TForm)
    ButtonCheck: TButton;
    ButtonGenerate: TButton;
    GroupBoxGenderSelector: TGroupBox;
    LabeledEditPlaceNumber: TLabeledEdit;
    LabeledEditBirthDate: TLabeledEdit;
    LabeledEditIDNumber: TLabeledEdit;
    RadioButtonGerderFemale: TRadioButton;
    RadioButtonGenderMale: TRadioButton;
    procedure ButtonCheckClick(Sender: TObject);
    procedure ButtonGenerateClick(Sender: TObject);
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
  orderNum: String;
  checkNum: Char;
  tempNum: String;
begin
  Randomize;
  orderNum := MaskIntStr(Random(1000), 4);
  tempNum := LabeledEditPlaceNumber.Text + LabeledEditBirthDate.Text + orderNum;
  checkNum := GetCheck(tempNum);
  if checkNum = '?' then Application.MessageBox('输入不正确，请检查输入。', '提示信息')
  else LabeledEditIDNumber.Text := tempNum + checkNum;
end;

procedure TMainForm.ButtonCheckClick(Sender: TObject);
begin
  if IsValidIDNum(LabeledEditIDNumber.Text) then Application.MessageBox('是一个有效的身份证号码', '提示信息')
  else Application.MessageBox('不是一个有效的身份证号码', '提示信息');
end;

end.

