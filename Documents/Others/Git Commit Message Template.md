# Git Commit Styles for this project

## Tips

### Specify the type of commit:

> Feature : The new feature you're adding to a particular application
>
> > _Format_
>
> > Feature : (Feature_Name) [Current_State]
> > For Example:
> >
> > > Feature : (Booking) [WIP] Add table for bookings
> > > Feature : (Booking) [FINAL] Final Commit for Booking Feature

> Fix : A bug fix
> Style : Feature and updates related to styling
> Refactor : Refactoring a specific section of the codebase
> Test : Everything related to testing
> Docs : Everything related to documentation
> Chore : Regular code maintenance.[ You can also use emojis to represent commit types]

### Other tips

> -   Separate the subject from the body with a blank line
> -   Your commit message should not contain any whitespace errors
> -   Remove unnecessary punctuation marks
> -   Do not end the subject line with a period
> -   Capitalize the subject line and each paragraph
> -   Use the imperative mood in the subject line
> -   Use the body to explain what changes you have made and why you made them.
> -   Do not assume the reviewer understands what the original problem was, ensure you add it.
> -   Do not think your code is self-explanatory

## General Format

> `Type of Commit : {What you've done - high level}`
>
> `> {short explanation for why you did it}`
>
> `~ {this indicates a change to method/css/something}`
> `- {this indicates a removal of a method/css/something}`
> `+ {this indicates the addition of a method/css/something}`

## Example

> `Refactor : Change to login function on session.php`
>
> `> The function was too long, had to break it down into smaller functions.`
>
> `~ login() from session.php`
> `- onlogin() from session.php`
> `+ Open Authentication Login`
