
require('lodash');

class Str
{
    constructor()
    {}

    limit(str, maxlen=30, ommision='...')
    {
        return _.truncate(str, {
            length: maxlen,
            separator: / /,
            omission: omission
        });
    }

    slug(str='')
    {
        return _.replace(str, /-/g, '-');
    }

    unslug(str='')
    {
        return _.replace(str, / /g, ' ');
    }

    title(str)
    {
        return _.startCase(_.toLower(str));
    }
}

export default new Str;