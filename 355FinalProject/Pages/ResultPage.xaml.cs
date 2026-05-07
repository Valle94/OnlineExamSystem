using _355FinalProject.Models;

namespace _355FinalProject.Pages;

public partial class ResultPage : ContentPage, IQueryAttributable
{

	public ResultPage()
	{
		InitializeComponent();
	}

    public void ApplyQueryAttributes(IDictionary<string, object> query)
    {
        StudentId.Text = $"Student ID: {query["studentID"]}";
        FirstName.Text = $"First Name: {query["firstName"]}";
        LastName.Text = $"Last Name: {query["lastName"]}";
        Email.Text = $"Email: {query["email"]}";
        Score.Text = $"Score: {query["score"]}%";
        Correct.Text = $"Correct Answers: {query["correctCount"]}";
        Wrong.Text = $"Wrong Answers: {query["wrongCount"]}";
        Total.Text = $"Total Questions: {query["totalCount"]}";
        Date.Text = $"Date: {query["date"]}";
        Time.Text = $"Time: {query["time"]}";
        Q1Student.Text = $"Your Answer: {query["studentAnsQ1"]}";
        Q2Student.Text = $"Your Answer: {query["studentAnsQ2"]}";
        Q3Student.Text = $"Your Answer: {query["studentAnsQ3"]}";
        Q4Student.Text = $"Your Answer: {query["studentAnsQ4"]}";
        Q5Student.Text = $"Your Answer: {query["studentAnsQ5"]}";
    }

    private async void GoHome(object sender, EventArgs e)
    {
       await Shell.Current.GoToAsync("///HomePage");
    }
}