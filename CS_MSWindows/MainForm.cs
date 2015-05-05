using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
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
		char getCheck(string idNum)
		{
			var xs = new [] {
				7,
				9,
				10,
				5,
				8,
				4,
				2,
				1,
				6,
				3,
				7,
				9,
				10,
				5,
				8,
				4,
				2
			};
			const string lst = "10X98765432";
			int sumOfId = 0;
			for (int i = 0; i < 17; i++)
				sumOfId += (Convert.ToInt32(idNum[i].ToString()) * xs[i]);
			return lst[sumOfId % 11];
		}
		void callPlacesFormBtn_Click(object sender, EventArgs e)
		{
			Form idpsf = new IDPlacesShowForm();
			idpsf.Show();
		}

		void checkBtn_Click(object sender, EventArgs e)
		{
			if (idNumBox.Text.Length != 18) {
				MessageBox.Show("长度不符合规范。", "结果");
				return;
			}
			if (idNumBox.Text[17] == getCheck(idNumBox.Text))
				MessageBox.Show(idNumBox.Text + "\n校检通过。", "结果");
			else
				MessageBox.Show(idNumBox.Text + "\n校检不通过。", "结果");
		}

		void generateBtn_Click(object sender, EventArgs e)
		{
			string xIDNum = placeCodeBox.Text + birthBox.Text;
			int rdidNum = Rnd.Next(500) * 2;
			if (sexSelect_1.Checked)
				rdidNum += 1;
			string xFd = rdidNum.ToString();
			for (int i = 0; i < 3 - xFd.Length; i++)
				xIDNum += "0";
			xIDNum += xFd;
			idNumBox.Text = xIDNum + getCheck(xIDNum);
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

	}
}
