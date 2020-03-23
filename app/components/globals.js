module.exports = {
  methods: {
    isOptional: function (value) {
      if (value === null || value === "") {
        return null;
      }
      if (typeof value !== "undefined" && value.length == 0) {
        return [];
      } else return value;
    },
    capitalizeString: function(string){
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
  }
}