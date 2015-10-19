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
    EditOrderNumber: TEdit;
    GroupBoxGenderSelector: TGroupBox;
    LabeledEditPlaceNumber: TLabeledEdit;
    LabeledEditBirthDate: TLabeledEdit;
    LabeledEditIDNumber: TLabeledEdit;
    RadioButtonDefineOrderNumber: TRadioButton;
    RadioButtonGerderFemale: TRadioButton;
    RadioButtonGenderMale: TRadioButton;
    procedure ButtonCheckClick(Sender: TObject);
    procedure ButtonGenerateClick(Sender: TObject);
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

procedure TMainForm.RadioButtonDefineOrderNumberChange(Sender: TObject);
begin
  if RadioButtonDefineOrderNumber.Checked then EditOrderNumber.Enabled := True
  else EditOrderNumber.Enabled := False;
end;

procedure TMainForm.ButtonCheckClick(Sender: TObject);
begin
  if IsValidIDNum(LabeledEditIDNumber.Text) then Application.MessageBox('是一个有效的身份证号码', '提示信息')
  else Application.MessageBox('不是一个有效的身份证号码', '提示信息');
end;

end.

