unit UnitFormPlacesList;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, FileUtil, Forms, Controls, Graphics, Dialogs, StdCtrls, Buttons,
  PlacesList;

type

  { TFormPlacesList }

  TFormPlacesList = class(TForm)
    BitBtnSearch: TBitBtn;
    EditSearch: TEdit;
    LabelPerv: TLabel;
    LabelNext: TLabel;
    StaticTextListContent: TStaticText;
    procedure BitBtnSearchClick(Sender: TObject);
    procedure FormCloseQuery(Sender: TObject; var CanClose: boolean);
    procedure FormCreate(Sender: TObject);
    procedure LabelNextClick(Sender: TObject);
    procedure LabelPervClick(Sender: TObject);
    procedure LoadList(contentOffset: Integer);
  private
    { private declarations }
    pageOffset: Integer;
    pageEndOffset: Integer;
  public
    { public declarations }
  end;

var
  FormPlacesList: TFormPlacesList;

implementation

{$R *.lfm}


{ TFormPlacesList }

procedure TFormPlacesList.LabelNextClick(Sender: TObject);
begin
  LoadList(pageEndOffset + 1);
end;

procedure TFormPlacesList.LabelPervClick(Sender: TObject);
begin
  LoadList(pageOffset - 21);
end;

procedure TFormPlacesList.FormCreate(Sender: TObject);
begin
  LoadList(1);
end;

procedure TFormPlacesList.FormCloseQuery(Sender: TObject; var CanClose: boolean);
begin
  CanClose := False;
  Hide;
end;

procedure TFormPlacesList.BitBtnSearchClick(Sender: TObject);
var
  i: Integer;
  foundPos: Integer;
begin
  foundPos := 0;
  if Length(EditSearch.Text) > 0 then begin
    for i := 1 to Length(placeNumbers) do begin
      if Pos(EditSearch.Text, placeNames[i]) > 0 then begin
        foundPos := i;
        Break;
      end;
    end;
  end;
  if foundPos > 0 then LoadList(foundPos);
end;

procedure TFormPlacesList.LoadList(contentOffset: Integer);
var
  listLength: Integer;
  i: Integer;
  showContent: String;
begin
  listLength := Length(placeNumbers);
  showContent := '';
  if contentOffset < 1 then contentOffset := 1;
  if contentOffset > listLength then Exit
  else begin
    pageOffset := contentOffset;
    pageEndOffset := contentOffset + 20;
    if pageEndOffset > listLength then pageEndOffset := listLength;
    for i := pageOffset to pageEndOffset do begin
      showContent := showContent + IntToStr(placeNumbers[i]) + ' - ' + placeNames[i] + #10;
    end;
    StaticTextListContent.Caption := showContent;
  end;
end;

end.

