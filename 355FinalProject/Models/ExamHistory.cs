using System;
using System.Collections.Generic;
using System.Text;

namespace _355FinalProject.Models
{
    public class ExamHistory
    {
        public int StudentID { get; set; }
        public string Date { get; set; }
        public string Time { get; set; }
        public int Score { get; set; }
        public int CorrectAnswers { get; set; }
        public int WrongAnswers { get; set; }
        public int RowIndex { get; set; }
    }
}
