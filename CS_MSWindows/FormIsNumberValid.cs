
using System;
using System.Windows.Forms;
using System.Text;

namespace PRCIDGenerator
{
	public partial class FormIsNumberValid : Form
	{
		readonly string[] xValues;
		public FormIsNumberValid(string[] showValues)
		{
			xValues = showValues;
			InitializeComponent();
		}
		void ButtonCloseClick(object sender, EventArgs e)
		{
			Close();
		}
		void FormIsNumberValidLoad(object sender, EventArgs e)
		{
			if (xValues.Length != 5) {
				Close();
			}
			string[] contentsPrefixs = { "身份证号码：", "性别：", "出生日期：", "身份证所在地：", "号码有效性：" };
			var showContents = new StringBuilder();
			for (int i = 0; i < 5; i++) {
				showContents.Append(contentsPrefixs[i]).AppendLine(xValues[i]);
			}
			richTextBoxResults.Text = showContents.ToString();
		}
	}
}
