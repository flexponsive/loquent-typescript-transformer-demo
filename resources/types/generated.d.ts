declare namespace App.Enums {
export type UserRole = 'admin' | 'guest' | 'professional';
}
declare namespace App.Models {
export type OrgUnit = {
incrementing: boolean;
preventsLazyLoading: boolean;
exists: boolean;
wasRecentlyCreated: boolean;
timestamps: boolean;
usesUniqueIds: boolean;
};
export type User = {
incrementing: boolean;
preventsLazyLoading: boolean;
exists: boolean;
wasRecentlyCreated: boolean;
timestamps: boolean;
usesUniqueIds: boolean;
};
}
