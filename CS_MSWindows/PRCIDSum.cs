
using System;

namespace PRCIDGenerator
{
	public static partial class PRCIDSum
	{
		public static char getCheckChar(string idNumString)
		{
			if (idNumString.Length < 17 || idNumString.Length > 18) {
				return '?';
			}
			for (int i = 0; i < 16; i++) {
				if (idNumString[i] < '0' || idNumString[i] > '9') {
					return '?';
				}
			}
			int sumOfId = 0;
			for (int i = 0; i < 16; i++) {
				sumOfId += Convert.ToInt32(idNumString[i].ToString()) * numberWeighingList[i];
			}
			return lastNumberIndex[sumOfId % 11];
		}
		public static bool isValidIdNum(string idNumString)
		{
			if (idNumString.Length != 18) {
				return false;
			}
			if (idNumString[17] >= '0' && idNumString[17] <= '9' || idNumString[17] == 'X') {
				return idNumString[17] == getCheckChar(idNumString);
			}
			return false;
		}
		public static string getNumberPlace(string idNumString)
		{
			if (idNumString.Length < 6) {
				return "Syntax Error";
			}
			foreach (char idChar in idNumString.Substring(0,6)) {
				if (idChar < '0' || idChar > '9') {
					return "Syntax Error";
				}
			}
			int idx = Array.IndexOf(placesIdList, Convert.ToInt32(idNumString.Substring(0, 6)));
			return idx == -1 ? "Unknown" : placesList[idx];
		}
		public static int dayOfYearMonth(int year, int month)
		{
			if (month < 1 || month > 12)
				return 0;
			int[] month30Days = { 4, 6, 9, 11 };
			if (Array.IndexOf(month30Days, month) != -1) {
				return 30;
			}
			if (month == 2) {
				if (year % 100 == 0) {
					year = year / 100;
				}
				return year / 4 == 0 ? 29 : 28;
			}
			return 31;
		}
		public static string[] getInformationsInIdNumber(string idNumString)
		{
			if (idNumString.Length != 18) {
				return new [] { idNumString, "", "", "", "无效号码" };
			}
			return new [] {
				idNumString,
				Convert.ToInt32(idNumString[16].ToString()) % 2 == 0 ? "男" : "女",
				idNumString.Substring(6, 4) + "年" + idNumString.Substring(10, 2) + "月" + idNumString.Substring(12, 2) + "日",
				getNumberPlace(idNumString),
				isValidIdNum(idNumString) ? "有效号码" : "无效号码"
			};
		}
	}
}
