namespace PRCIDGenerator
{
    partial class MainForm
    {
        /// <summary>
        /// 必需的设计器变量。
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// 清理所有正在使用的资源。
        /// </summary>
        /// <param name="disposing">如果应释放托管资源，为 true；否则为 false。</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows 窗体设计器生成的代码

        /// <summary>
        /// 设计器支持所需的方法 - 不要
        /// 使用代码编辑器修改此方法的内容。
        /// </summary>
        private void InitializeComponent()
        {
            var resources = new System.ComponentModel.ComponentResourceManager(typeof(MainForm));
            this.callPlacesFormBtn = new System.Windows.Forms.Button();
            this.sexSelect_1 = new System.Windows.Forms.RadioButton();
            this.sexSelect_2 = new System.Windows.Forms.RadioButton();
            this.placeCodeBox = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.birthBox = new System.Windows.Forms.TextBox();
            this.generateBtn = new System.Windows.Forms.Button();
            this.idNumBox = new System.Windows.Forms.TextBox();
            this.checkBtn = new System.Windows.Forms.Button();
            this.label3 = new System.Windows.Forms.Label();
            this.helpBtn = new System.Windows.Forms.Button();
            this.exitBtn = new System.Windows.Forms.Button();
            this.plcPasteBtn = new System.Windows.Forms.Button();
            this.copyIdBtn = new System.Windows.Forms.Button();
            this.pasteIdBtn = new System.Windows.Forms.Button();
            this.pasteBirthBtn = new System.Windows.Forms.Button();
            this.button1 = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // callPlacesFormBtn
            // 
            this.callPlacesFormBtn.Location = new System.Drawing.Point(118, 24);
            this.callPlacesFormBtn.Name = "callPlacesFormBtn";
            this.callPlacesFormBtn.Size = new System.Drawing.Size(22, 21);
            this.callPlacesFormBtn.TabIndex = 0;
            this.callPlacesFormBtn.TabStop = false;
            this.callPlacesFormBtn.Text = "？";
            this.callPlacesFormBtn.UseVisualStyleBackColor = true;
            this.callPlacesFormBtn.Click += new System.EventHandler(this.callPlacesFormBtn_Click);
            // 
            // sexSelect_1
            // 
            this.sexSelect_1.AutoSize = true;
            this.sexSelect_1.Checked = true;
            this.sexSelect_1.Location = new System.Drawing.Point(182, 29);
            this.sexSelect_1.Name = "sexSelect_1";
            this.sexSelect_1.Size = new System.Drawing.Size(35, 16);
            this.sexSelect_1.TabIndex = 2;
            this.sexSelect_1.TabStop = true;
            this.sexSelect_1.Text = "男";
            this.sexSelect_1.UseVisualStyleBackColor = true;
            // 
            // sexSelect_2
            // 
            this.sexSelect_2.AutoSize = true;
            this.sexSelect_2.Location = new System.Drawing.Point(182, 48);
            this.sexSelect_2.Name = "sexSelect_2";
            this.sexSelect_2.Size = new System.Drawing.Size(35, 16);
            this.sexSelect_2.TabIndex = 3;
            this.sexSelect_2.Text = "女";
            this.sexSelect_2.UseVisualStyleBackColor = true;
            // 
            // placeCodeBox
            // 
            this.placeCodeBox.Location = new System.Drawing.Point(12, 24);
            this.placeCodeBox.MaxLength = 6;
            this.placeCodeBox.Name = "placeCodeBox";
            this.placeCodeBox.Size = new System.Drawing.Size(100, 21);
            this.placeCodeBox.TabIndex = 0;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(10, 9);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(101, 12);
            this.label1.TabIndex = 4;
            this.label1.Text = "地区码（六位）：";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(10, 48);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(137, 12);
            this.label2.TabIndex = 5;
            this.label2.Text = "出生日期（YYYYMMDD）：";
            // 
            // birthBox
            // 
            this.birthBox.Location = new System.Drawing.Point(12, 63);
            this.birthBox.MaxLength = 8;
            this.birthBox.Name = "birthBox";
            this.birthBox.Size = new System.Drawing.Size(100, 21);
            this.birthBox.TabIndex = 1;
            // 
            // generateBtn
            // 
            this.generateBtn.Location = new System.Drawing.Point(182, 70);
            this.generateBtn.Name = "generateBtn";
            this.generateBtn.Size = new System.Drawing.Size(42, 21);
            this.generateBtn.TabIndex = 4;
            this.generateBtn.Text = "生成";
            this.generateBtn.UseVisualStyleBackColor = true;
            this.generateBtn.Click += new System.EventHandler(this.generateBtn_Click);
            // 
            // idNumBox
            // 
            this.idNumBox.Location = new System.Drawing.Point(12, 102);
            this.idNumBox.MaxLength = 18;
            this.idNumBox.Name = "idNumBox";
            this.idNumBox.Size = new System.Drawing.Size(118, 21);
            this.idNumBox.TabIndex = 5;
            // 
            // checkBtn
            // 
            this.checkBtn.Location = new System.Drawing.Point(136, 102);
            this.checkBtn.Name = "checkBtn";
            this.checkBtn.Size = new System.Drawing.Size(25, 21);
            this.checkBtn.TabIndex = 6;
            this.checkBtn.Text = "!";
            this.checkBtn.UseVisualStyleBackColor = true;
            this.checkBtn.Click += new System.EventHandler(this.checkBtn_Click);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(12, 87);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(77, 12);
            this.label3.TabIndex = 10;
            this.label3.Text = "身份证号码：";
            // 
            // helpBtn
            // 
            this.helpBtn.Location = new System.Drawing.Point(14, 129);
            this.helpBtn.Name = "helpBtn";
            this.helpBtn.Size = new System.Drawing.Size(53, 20);
            this.helpBtn.TabIndex = 11;
            this.helpBtn.TabStop = false;
            this.helpBtn.Text = "说明";
            this.helpBtn.UseVisualStyleBackColor = true;
            this.helpBtn.Click += new System.EventHandler(this.helpBtn_Click);
            // 
            // exitBtn
            // 
            this.exitBtn.Location = new System.Drawing.Point(171, 129);
            this.exitBtn.Name = "exitBtn";
            this.exitBtn.Size = new System.Drawing.Size(53, 20);
            this.exitBtn.TabIndex = 7;
            this.exitBtn.Text = "退出";
            this.exitBtn.UseVisualStyleBackColor = true;
            this.exitBtn.Click += new System.EventHandler(this.exitBtn_Click);
            // 
            // plcPasteBtn
            // 
            this.plcPasteBtn.Location = new System.Drawing.Point(146, 24);
            this.plcPasteBtn.Name = "plcPasteBtn";
            this.plcPasteBtn.Size = new System.Drawing.Size(22, 21);
            this.plcPasteBtn.TabIndex = 13;
            this.plcPasteBtn.TabStop = false;
            this.plcPasteBtn.Text = "P";
            this.plcPasteBtn.UseVisualStyleBackColor = true;
            this.plcPasteBtn.Click += new System.EventHandler(this.plcPasteBtn_Click);
            // 
            // copyIdBtn
            // 
            this.copyIdBtn.Location = new System.Drawing.Point(167, 102);
            this.copyIdBtn.Name = "copyIdBtn";
            this.copyIdBtn.Size = new System.Drawing.Size(25, 21);
            this.copyIdBtn.TabIndex = 14;
            this.copyIdBtn.TabStop = false;
            this.copyIdBtn.Text = "C";
            this.copyIdBtn.UseVisualStyleBackColor = true;
            this.copyIdBtn.Click += new System.EventHandler(this.copyIdBtn_Click);
            // 
            // pasteIdBtn
            // 
            this.pasteIdBtn.Location = new System.Drawing.Point(198, 102);
            this.pasteIdBtn.Name = "pasteIdBtn";
            this.pasteIdBtn.Size = new System.Drawing.Size(26, 21);
            this.pasteIdBtn.TabIndex = 15;
            this.pasteIdBtn.TabStop = false;
            this.pasteIdBtn.Text = "P";
            this.pasteIdBtn.UseVisualStyleBackColor = true;
            this.pasteIdBtn.Click += new System.EventHandler(this.pasteIdBtn_Click);
            // 
            // pasteBirthBtn
            // 
            this.pasteBirthBtn.Location = new System.Drawing.Point(118, 63);
            this.pasteBirthBtn.Name = "pasteBirthBtn";
            this.pasteBirthBtn.Size = new System.Drawing.Size(22, 21);
            this.pasteBirthBtn.TabIndex = 16;
            this.pasteBirthBtn.TabStop = false;
            this.pasteBirthBtn.Text = "P";
            this.pasteBirthBtn.UseVisualStyleBackColor = true;
            this.pasteBirthBtn.Click += new System.EventHandler(this.pasteBirthBtn_Click);
            // 
            // button1
            // 
            this.button1.Location = new System.Drawing.Point(199, 4);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(25, 22);
            this.button1.TabIndex = 17;
            this.button1.TabStop = false;
            this.button1.Text = "CA";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // MainForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 12F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(238, 160);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.pasteBirthBtn);
            this.Controls.Add(this.pasteIdBtn);
            this.Controls.Add(this.copyIdBtn);
            this.Controls.Add(this.plcPasteBtn);
            this.Controls.Add(this.exitBtn);
            this.Controls.Add(this.helpBtn);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.checkBtn);
            this.Controls.Add(this.idNumBox);
            this.Controls.Add(this.generateBtn);
            this.Controls.Add(this.birthBox);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.placeCodeBox);
            this.Controls.Add(this.sexSelect_2);
            this.Controls.Add(this.sexSelect_1);
            this.Controls.Add(this.callPlacesFormBtn);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedToolWindow;
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "MainForm";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "中国大陆身份证号计算工具";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button callPlacesFormBtn;
        private System.Windows.Forms.RadioButton sexSelect_1;
        private System.Windows.Forms.RadioButton sexSelect_2;
        private System.Windows.Forms.TextBox placeCodeBox;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox birthBox;
        private System.Windows.Forms.Button generateBtn;
        private System.Windows.Forms.TextBox idNumBox;
        private System.Windows.Forms.Button checkBtn;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button helpBtn;
        private System.Windows.Forms.Button exitBtn;
        private System.Windows.Forms.Button plcPasteBtn;
        private System.Windows.Forms.Button copyIdBtn;
        private System.Windows.Forms.Button pasteIdBtn;
        private System.Windows.Forms.Button pasteBirthBtn;
        private System.Windows.Forms.Button button1;
    }
}

