using System;
using System.Text;
using System.Windows.Forms;

namespace PRCIDGenerator
{
	public partial class MainForm : Form
	{
		Random Rnd = new Random();
		public MainForm()
		{
			InitializeComponent();
		}

		void callPlacesFormBtn_Click(object sender, EventArgs e)
		{
			Form idpsf = new IDPlacesShowForm();
			idpsf.Show();
		}

		void checkBtn_Click(object sender, EventArgs e)
		{
			var vForm = new FormIsNumberValid(PRCIDSum.getInformationsInIdNumber(idNumBox.Text));
			vForm.ShowDialog(this);
			//Hide();
		}

		void generateBtn_Click(object sender, EventArgs e)
		{
			var generatedIdNumber = new StringBuilder();
			generatedIdNumber.Append(placeCodeBox.Text).Append(birthBox.Text);
			int rdidNum = Rnd.Next(500) * 2;
			if (sexSelect_1.Checked)
				rdidNum += 1;
			generatedIdNumber.Append(rdidNum.ToString("D3"));
			char checkChr = PRCIDSum.getCheckChar(generatedIdNumber.ToString());
			idNumBox.Text = checkChr == '?' ? "输入不符规范" : generatedIdNumber.Append(checkChr).ToString();
		}

		void helpBtn_Click(object sender, EventArgs e)
		{
			MessageBox.Show("要生成身份证号码，您需要提供三个信息：\n地区编码/生日/性别\n您可以点击“？”来参考地区编码所对应的地区。\n要验证身份证号，请输入身份证号并点击后面的“！”。\n本身份证号计算工具仅是从算法上验证，对应的身份证号码在现实中可能并不存在。\n请勿将本程序用于商业或任何非法用途！", "说明");
		}

		void exitBtn_Click(object sender, EventArgs e)
		{
			Close();
		}

		void plcPasteBtn_Click(object sender, EventArgs e)
		{
			placeCodeBox.Text = Clipboard.GetText();
		}

		void pasteBirthBtn_Click(object sender, EventArgs e)
		{
			birthBox.Text = Clipboard.GetText();
		}

		void pasteIdBtn_Click(object sender, EventArgs e)
		{
			idNumBox.Text = Clipboard.GetText();
		}

		void copyIdBtn_Click(object sender, EventArgs e)
		{
			Clipboard.SetText(idNumBox.Text);
		}

		void button1_Click(object sender, EventArgs e)
		{
			placeCodeBox.Text = birthBox.Text = idNumBox.Text = "";
			sexSelect_1.Checked = true;
		}
		void BtnRandomGenerateClick(object sender, EventArgs e)
		{
			var ra = new Random();
			int ryear = Convert.ToInt32(DateTime.Now.Year.ToString()) - ra.Next(19, 60);
			int rmonth = ra.Next(1, 12);
			int rday = ra.Next(1, PRCIDSum.dayOfYearMonth(ryear, rmonth));
			birthBox.Text = ryear + rmonth.ToString("D2") + rday.ToString("D2");
			placeCodeBox.Text = PRCIDSum.placesIdList[ra.Next(0, PRCIDSum.placesIdList.Length)].ToString();
			generateBtn_Click(sender, e);
		}

	}
}
