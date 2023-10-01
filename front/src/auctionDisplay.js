export function numberLeadingZeros(number, numZeros) 
{
    if (number < 10**numZeros) 
    {
      // Pad the number with leading zeros
      let ldZeros = "0".repeat(numZeros-1);
      return (ldZeros + number).slice(-numZeros);
    }

    return number.toString();
}

export function getDateDelta(date) 
{
    const now = Date.now();
    const delta = date - now;
    
    if (delta <= 0) 
    {
        return {
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
        };
    }

    const days = Math.floor(delta / (1000 * 60 * 60 * 24));
    let secs = Math.max(0, Math.floor(delta / 1000));
    let mins = Math.max(0, Math.floor(secs / 60));
    let hours = Math.max(0, Math.floor(mins / 60));

    secs = secs % 60;
    mins = mins % 60;
    hours = hours % 24;

    return {
        days: days,
        hours: hours,
        mins: mins,
        secs: secs,
    };
}