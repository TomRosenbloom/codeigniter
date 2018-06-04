# Codeigniter Contacts

The specification:

We would like you to look at PHP, MySQL and optionally CodeIgniter framework and develop a simple contact database.

It needs a functionality to add, edit, deactivate and list records.

Sample fields for the database: Salutation, first name, middle name, last name, date of birth, address, city, postcode, tel, email.

It would be nice if all data entry/update points had a simple validation. For example, email has to be in a correct format, DOB in a date format etc.

You can do this in a standard PHP. If you would like to look at the framework we use, you can download Codeigniter 3.1.6 from here: [https://codeigniter.com](https://codeigniter.com/). There are some tutorials on youtube if you are interested.

For the front end, we use Foundation 6 framework and jQuery. However, you can code yours in plain CSS and HTML, although there will be extra points for user Foundation 6.

## My solution

- CRUD for Contacts using Codeigniter
  - list existing contacts in a table
    - edit, de/re-activate, or delete contact directly from table row
    - or view first, then edit, de/re-activate or delete from there
    - deactivated records shown greyed out
  - create/edit 
    - out of the box validation for required fields and correct email format
    - my function for validating postcode - allows full postcode or just an area code. The core validation methods are in Postcode model, then used in Contact controller
    - use of form partial for create and edit forms
    - user is returned to correct page of pagination following edit regardless of which route used
  - confirmation before deletion and de/re-activation
  - flash message confirmations after CRUD actions and after login
  - soft delete
  - 
- Very simple data model: a table of Contacts, two look-up tables for foreign key relations to Honorific and City
- Simple authentication using Ion-auth
- View templates
- Migrations
- htaccess in root for security
- Use of Foundation styles and scripts

## Further development

The current system is very PHP heavy and as such is a little old-fashioned. There's a lot of client/server interaction that could be avoided with greater use of Javascript. The confirmation forms for deactivation and deletion could be replaced with modal dialogues. The listing could be done with javascript Datatables or similar. There are some additional features that could be added with javascript e.g. an Ajax lookup to check for possible duplicates when entering a contact.

There are pros and cons to making a system like this more server side/client side. Most of the arguments for avoiding Javascipt are outdated (?). 

The reason it's turned out this way is I've concentrated most of my effort on learning Codeigniter. One thing in particular that I ended up spending a lot of time on was getting pagination working and then reconciling it with routing e.g. when allowing for ordering on column heads. I could have avoided this by using Datatables, but I wanted to properly understand CI as much as possible.

Use SASS to compile assets esp. to incorporate motion-ui to allow dismissing flash messages

Filtering/searching