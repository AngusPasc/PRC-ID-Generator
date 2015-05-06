
namespace PRCIDGenerator
{
	partial class FormIsNumberValid
	{
		/// <summary>
		/// Designer variable used to keep track of non-visual components.
		/// </summary>
		private System.ComponentModel.IContainer components = null;
		private System.Windows.Forms.RichTextBox richTextBoxResults;
		private System.Windows.Forms.Button buttonClose;
		
		/// <summary>
		/// Disposes resources used by the form.
		/// </summary>
		/// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
		protected override void Dispose(bool disposing)
		{
			if (disposing) {
				if (components != null) {
					components.Dispose();
				}
			}
			base.Dispose(disposing);
		}
		
		/// <summary>
		/// This method is required for Windows Forms designer support.
		/// Do not change the method contents inside the source code editor. The Forms designer might
		/// not be able to load this method if it was changed manually.
		/// </summary>
		private void InitializeComponent()
		{
			this.richTextBoxResults = new System.Windows.Forms.RichTextBox();
			this.buttonClose = new System.Windows.Forms.Button();
			this.SuspendLayout();
			// 
			// richTextBoxResults
			// 
			this.richTextBoxResults.BackColor = System.Drawing.SystemColors.Control;
			this.richTextBoxResults.BorderStyle = System.Windows.Forms.BorderStyle.None;
			this.richTextBoxResults.DetectUrls = false;
			this.richTextBoxResults.ImeMode = System.Windows.Forms.ImeMode.Off;
			this.richTextBoxResults.Location = new System.Drawing.Point(12, 12);
			this.richTextBoxResults.Name = "richTextBoxResults";
			this.richTextBoxResults.ReadOnly = true;
			this.richTextBoxResults.ScrollBars = System.Windows.Forms.RichTextBoxScrollBars.None;
			this.richTextBoxResults.Size = new System.Drawing.Size(284, 112);
			this.richTextBoxResults.TabIndex = 0;
			this.richTextBoxResults.TabStop = false;
			this.richTextBoxResults.Text = "";
			// 
			// buttonClose
			// 
			this.buttonClose.Location = new System.Drawing.Point(240, 130);
			this.buttonClose.Name = "buttonClose";
			this.buttonClose.Size = new System.Drawing.Size(56, 23);
			this.buttonClose.TabIndex = 1;
			this.buttonClose.Text = "关闭";
			this.buttonClose.UseVisualStyleBackColor = true;
			this.buttonClose.Click += new System.EventHandler(this.ButtonCloseClick);
			// 
			// FormIsNumberValid
			// 
			this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 12F);
			this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
			this.BackColor = System.Drawing.SystemColors.Control;
			this.ClientSize = new System.Drawing.Size(308, 165);
			this.Controls.Add(this.buttonClose);
			this.Controls.Add(this.richTextBoxResults);
			this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
			this.MaximizeBox = false;
			this.MaximumSize = new System.Drawing.Size(324, 204);
			this.MinimizeBox = false;
			this.Name = "FormIsNumberValid";
			this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
			this.Text = "号码有效性验证";
			this.Load += new System.EventHandler(this.FormIsNumberValidLoad);
			this.ResumeLayout(false);

		}
	}
}
