/**
 * Created by quent on 14/02/2018.
 */

function surligne(champ, erreur)
{
    if(erreur)
        champ.style.backgroundColor = "#fba";
    else
        champ.style.backgroundColor = "";
}

function verifField(field)
{
    if(field.value.length < 2 || field.value.length > 25)
    {
        surligne(field, true);
        return false;
    }
    else
    {
        surligne(field, false);
        return true;
    }
}

function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(!regex.test(champ.value))
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifForm(f)
{
    var fieldOk = verifField(f.name);
    var mailOk = verifMail(f.email);

    if(fieldOk && mailOk)
        return true;
    else
    {
        alert("Contact form not correctly completed.");
        return false;
    }
}

function verifRegisterForm(f)
{
    var firstnameOk = verifField(f.firstname);
    var lastnameOk = verifField(f.lastname);
    var mailOk = verifMail(f.email);

    if(firstnameOk && lastnameOk && mailOk)
        return true;
    else
    {
        alert("Register form not correctly completed.");
        return false;
    }
}